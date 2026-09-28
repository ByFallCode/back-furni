<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(private readonly PostRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        $paginator = $this->repository->paginate($perPage);
        $paginator->setCollection($paginator->getCollection()->map(
            static fn ($item) => new PostResource($item),
        ));
        return ApiResponse::paginated($paginator, 'Posts retrieved successfully.');
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $item = $this->repository->create($request->validated());
        return ApiResponse::created(new PostResource($item), 'Post created successfully.');
    }

    public function show(int|string $post): JsonResponse
    {
        $item = $this->repository->find($post);
        return ApiResponse::success(new PostResource($item), 'Post retrieved successfully.');
    }

    public function update(UpdatePostRequest $request, int|string $post): JsonResponse
    {
        $item = $this->repository->update($post, $request->validated());
        return ApiResponse::success(new PostResource($item), 'Post updated successfully.');
    }

    public function destroy(int|string $post): Response
    {
        $this->repository->delete($post);
        return ApiResponse::noContent();
    }
}