<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Order::query()->latest('id')->paginate($perPage);
    }

    /** @return Collection<int, Order> */
    public function all(): Collection
    {
        return Order::query()->latest('id')->get();
    }

    public function find(int|string $id): Order
    {
        return Order::query()->findOrFail($id);
    }

    public function create(array $data): Order
    {
        return Order::query()->create($data);
    }

    public function update(int|string $id, array $data): Order
    {
        $item = $this->find($id);
        $item->update($data);
        return $item;
    }

    public function delete(int|string $id): void
    {
        $item = $this->find($id);
        $item->delete();
    }
}
