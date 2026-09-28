<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Post::query()->latest('id')->paginate($perPage);
    }

    /** @return Collection<int, Post> */
    public function all(): Collection
    {
        return Post::query()->latest('id')->get();
    }

    public function find(int|string $id): Post
    {
        return Post::query()->findOrFail($id);
    }

    public function create(array $data): Post
    {
        return Post::query()->create($data);
    }

    public function update(int|string $id, array $data): Post
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
