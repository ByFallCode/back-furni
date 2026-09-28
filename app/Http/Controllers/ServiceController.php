<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Repositories\ServiceRepository;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function __construct(private readonly ServiceRepository $repository) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) ($request->integer('per_page') ?: 15);
        $paginator = $this->repository->paginate($perPage);
        $paginator->setCollection($paginator->getCollection()->map(
            static fn ($item) => new ServiceResource($item),
        ));
        return ApiResponse::paginated($paginator, 'Services retrieved successfully.');
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {
        $item = $this->repository->create($request->validated());
        return ApiResponse::created(new ServiceResource($item), 'Service created successfully.');
    }

    public function show(int|string $service): JsonResponse
    {
        $item = $this->repository->find($service);
        return ApiResponse::success(new ServiceResource($item), 'Service retrieved successfully.');
    }

    public function update(UpdateServiceRequest $request, int|string $service): JsonResponse
    {
        $item = $this->repository->update($service, $request->validated());
        return ApiResponse::success(new ServiceResource($item), 'Service updated successfully.');
    }

    public function destroy(int|string $service): Response
    {
        $this->repository->delete($service);
        return ApiResponse::noContent();
    }
}