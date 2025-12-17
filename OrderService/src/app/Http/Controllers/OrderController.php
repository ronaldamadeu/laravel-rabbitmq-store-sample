<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected Model $model;
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $data = $request->only(['product_id', 'count']);
        $order = $this->model->create($data);

        return response()->json([
            'data' => $order,
            'message' => 'Order created successfully.'
        ], 201);
    }

    public function index()
    {
        $orders = $this->model->all();

        return response()->json([
            'data' => $orders
        ], 200);
    }
}
