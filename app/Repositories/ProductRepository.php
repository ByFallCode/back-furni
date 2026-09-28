<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Product::query()->latest('id')->paginate($perPage);
    }

    /** @return Collection<int, Product> */
    public function all(): Collection
    {
        return Product::query()->latest('id')->get();
    }

    public function find(int|string $id): Product
    {
        return Product::query()->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::query()->create($data);
    }

    public function update(int|string $id, array $data): Product
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
