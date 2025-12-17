<?php

namespace App\Http\Controllers;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $data = $request->only(['product_id', 'count']);
        $order = $this->service->create($data);

        return response()->json([
            'data' => $order,
            'message' => 'Order created successfully.'
        ], 201);
    }

    public function index()
    {
        $orders = $this->service->all();

        return response()->json([
            'data' => $orders
        ], 200);
    }
}
