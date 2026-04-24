<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreEnrollmentRequest;
use App\Http\Requests\Api\v1\UpdateEnrollmentRequest;
use App\Http\Resources\Api\v1\EnrollmentResource;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EnrollmentController extends Controller
{
    public function __construct(protected EnrollmentService $service) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = (int) $request->query('per_page', 15);
        $enrollments = $this->service->getAllPaginated($perPage);

        return EnrollmentResource::collection($enrollments);
    }

    public function store(StoreEnrollmentRequest $request): EnrollmentResource
    {
        return new EnrollmentResource($this->service->create($request->validated()));
    }

    public function show(int $id): EnrollmentResource
    {
        return new EnrollmentResource($this->service->getById($id));
    }

    public function update(UpdateEnrollmentRequest $request, int $id): EnrollmentResource
    {
        $this->service->update($id, $request->validated());

        return new EnrollmentResource($this->service->getById($id));
    }

    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
