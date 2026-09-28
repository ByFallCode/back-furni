<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Service::query()->latest('id')->paginate($perPage);
    }

    /** @return Collection<int, Service> */
    public function all(): Collection
    {
        return Service::query()->latest('id')->get();
    }

    public function find(int|string $id): Service
    {
        return Service::query()->findOrFail($id);
    }

    public function create(array $data): Service
    {
        return Service::query()->create($data);
    }

    public function update(int|string $id, array $data): Service
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
