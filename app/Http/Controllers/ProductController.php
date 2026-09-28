<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private readonly ProductRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        return response()->json(new ProductCollection($this->repository->paginate($perPage)));
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $item = $this->repository->create($request->validated());
        return response()->json(new ProductResource($item), 201);
    }

    public function show(int|string $product): JsonResponse
    {
        return response()->json(new ProductResource($this->repository->find($product)));
    }

    public function update(UpdateProductRequest $request, int|string $product): JsonResponse
    {
        $item = $this->repository->update($product, $request->validated());
        return response()->json(new ProductResource($item));
    }

    public function destroy(int|string $product): JsonResponse
    {
        $this->repository->delete($product);
        return response()->json(null, 204);
    }
}
