<?php

namespace App\Services;

use App\Jobs\OrderCreated;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Order
    {
        $order = $this->model->create($data);
        OrderCreated::dispatch($order->toArray());

        return $order;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
