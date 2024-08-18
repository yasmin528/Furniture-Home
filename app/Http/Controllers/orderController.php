<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\order;
use Illuminate\View\View;

class orderController extends Controller
{
    public function index(): view
    {
        $orders = order::where('user_id' , Auth::id())->get();
        return view('order.cart', compact('orders'));
    }

    public function store(Request $request)
    {
        $product = DB::table('products')->where('id', request('product_id'))->first();

        if($product) {
            DB::table('products')
                ->where('id', request('product_id'))
                ->decrement('quantity', request('quantity'));

            $order = order::where('user_id' , Auth::id())->where('product_id' , request('product_id'))->first();

            if($order) {
                    $order->update([
                        'quantity' => $order->quantity + request('quantity'),
                        'total_price' => ($order->quantity+request('quantity')) * $product->price
                    ]);
            }else {
                DB::table('orders')->insert([
                    'product_id' => request('product_id'),
                    'quantity' => request('quantity'),
                    'user_id' => auth()->id(),
                    'total_price' => request('quantity') * $product->price
                ]);
            }
            return redirect()->route('home');
        }

        return view('not_found');
    }

    public function update(Request $request, string $id)
    {
        $order = order::where('id', $id)->first();
        if($order) {
            $order->update([
                'quantity' => request('quantity'),
                'total_price' => request('quantity') * $order->product->price
            ]);
            return response()->json([
                'success' => true,
                'total_price' => $order->total_price
            ]);
        }
        return response()->json(['success' => false], 404);
    }
    public function destroy(string $id)
    {
        $order = order::where('id', $id)->first();

        if($order) {
            DB::table('products')
                ->where('id', $order->product_id)
                ->increment('quantity', $order->quantity);
            $order->delete();
            return redirect('order');
        }
        return view('not_found');
    }
}
