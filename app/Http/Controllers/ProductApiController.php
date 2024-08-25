<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $product = product::all();
        $data = [
          'product' => $product
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image_url' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 400);
        }
        else{
            $product = Product::create($request->only(['name', 'price', 'quantity', 'description', 'image_url']));

            $data = [
                'message' => 'Product created'
            ];
            return response()->json($data, 200);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string',
            'image_url' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 400);
        }
        else{
            $product->update($request->only(['name', 'price', 'quantity', 'description', 'image_url']));

            $data = [
                'message' => 'Product updated'
            ];
            return response()->json($data, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        $data = [
            'message' => 'Product deleted'
        ];
        return response()->json($data, 200);
    }
}
