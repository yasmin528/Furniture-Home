<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : view
    {
        //
        $products = Product::all();
        return view('product.product_list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        //
        return view('product.product_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $imageName = time().'.'.$request->image_url->extension();
            $request->image_url->move(public_path('build/assets/images'), $imageName);

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'image_url' => $imageName,
            ]);
            return redirect()->route('products.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : view
    {
        //
        $product = Product::findOrFail($id);
        return view('product.product_show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): view
    {
        //
        $product = Product::findOrFail($id);
        return view('product.product_edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;

        // Handle image upload
        if ($request->hasFile('image_url')) {
            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('build/assets/images'), $imageName);
            $product->image_url = $imageName;
        }

        $product->save();

        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return redirect()->route('products.index');
    }
}
