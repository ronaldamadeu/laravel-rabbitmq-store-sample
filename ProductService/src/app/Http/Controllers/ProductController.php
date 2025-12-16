<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected Model $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'price', 'inventory']);
        $product = $this->model->create($data);

        return response()->json([
            'data' => $product,
            'message' => 'Product created successfully.'
        ], 201);
    }

    public function index()
    {
        $products = $this->model->all();

        return response()->json([
            'data' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = $this->model->find($id);

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
        $product = $this->model->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        $data = $request->only(['title', 'price', 'inventory']);
        $product->update($data);

        return response()->json([
            'data' => $product,
            'message' => 'Product updated successfully.'
        ], 200);
    }

    public function destroy($id)
    {
        $product = $this->model->find($id);

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
