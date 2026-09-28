<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\OrderItem\StoreOrderItemRequest;
use App\Http\Requests\OrderItem\UpdateOrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Repositories\OrderItemRepository;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderItemController extends Controller
{
    public function __construct(private readonly OrderItemRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        $paginator = $this->repository->paginate($perPage);
        $paginator->setCollection($paginator->getCollection()->map(
            static fn ($item) => new OrderItemResource($item),
        ));
        return ApiResponse::paginated($paginator, 'OrderItems retrieved successfully.');
    }

    public function store(StoreOrderItemRequest $request): JsonResponse
    {
        $item = $this->repository->create($request->validated());
        return ApiResponse::created(new OrderItemResource($item), 'OrderItem created successfully.');
    }

    public function show(int|string $order_item): JsonResponse
    {
        $item = $this->repository->find($order_item);
        return ApiResponse::success(new OrderItemResource($item), 'OrderItem retrieved successfully.');
    }

    public function update(UpdateOrderItemRequest $request, int|string $order_item): JsonResponse
    {
        $item = $this->repository->update($order_item, $request->validated());
        return ApiResponse::success(new OrderItemResource($item), 'OrderItem updated successfully.');
    }

    public function destroy(int|string $order_item): Response
    {
        $this->repository->delete($order_item);
        return ApiResponse::noContent();
    }
}