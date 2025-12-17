<?php

namespace App\Services;

use App\Jobs\OrderCreated;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    protected Product $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Product
    {
        $product = $this->model->create($data);
        return $product;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Product
    {
        return $this->model->find($id);
    }

    public function update(int $id, array $data): ?Product
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }
}
