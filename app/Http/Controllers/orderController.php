<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $product = Product::findOrFail(request('product_id'));

        $product->decrement('quantity', request('quantity'));

        $order = Order::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($order) {
            $order->update([
                'quantity' => $order->quantity + request('quantity'),
                'total_price' => ($order->quantity + request('quantity')) * $product->price,
            ]);
        } else {
            Order::create([
                'product_id' => $product->id,
                'quantity' => request('quantity'),
                'user_id' => auth()->id(),
                'total_price' => request('quantity') * $product->price,
            ]);
        }

        return redirect()->route('home');
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
        $order = Order::findOrFail($id);

        $product = Product::findOrFail($order->product_id);
        $product->increment('quantity', $order->quantity);

        $order->delete();

        return redirect('order');
    }
}
