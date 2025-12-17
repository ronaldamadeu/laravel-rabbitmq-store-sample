<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'price', 'inventory']);
        $product = $this->service->create($data);

        return response()->json([
            'data' => $product,
            'message' => 'Product created successfully.'
        ], 201);
    }

    public function index()
    {
        $products = $this->service->all();

        return response()->json([
            'data' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = $this->service->find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $product = $this->service->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        $data = $request->only(['title', 'price', 'inventory']);
        $product = $this->service->update($id, $data);

        return response()->json([
            'data' => $product,
            'message' => 'Product updated successfully.'
        ], 200);
    }

    public function destroy($id)
    {
        $product = $this->service->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully.'
        ], 200);
    }

}
