<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\OrderItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return OrderItem::query()->latest('id')->paginate($perPage);
    }

    /** @return Collection<int, OrderItem> */
    public function all(): Collection
    {
        return OrderItem::query()->latest('id')->get();
    }

    public function find(int|string $id): OrderItem
    {
        return OrderItem::query()->findOrFail($id);
    }

    public function create(array $data): OrderItem
    {
        return OrderItem::query()->create($data);
    }

    public function update(int|string $id, array $data): OrderItem
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
