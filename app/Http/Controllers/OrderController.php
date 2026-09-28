<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct(private readonly OrderRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        $paginator = $this->repository->paginate($perPage);
        $paginator->setCollection($paginator->getCollection()->map(
            static fn ($item) => new OrderResource($item),
        ));
        return ApiResponse::paginated($paginator, 'Orders retrieved successfully.');
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $item = $this->repository->create($request->validated());
        return ApiResponse::created(new OrderResource($item), 'Order created successfully.');
    }

    public function show(int|string $order): JsonResponse
    {
        $item = $this->repository->find($order);
        return ApiResponse::success(new OrderResource($item), 'Order retrieved successfully.');
    }

    public function update(UpdateOrderRequest $request, int|string $order): JsonResponse
    {
        $item = $this->repository->update($order, $request->validated());
        return ApiResponse::success(new OrderResource($item), 'Order updated successfully.');
    }

    public function destroy(int|string $order): Response
    {
        $this->repository->delete($order);
        return ApiResponse::noContent();
    }
}