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

use App\Models\Enrollment;
use Illuminate\Support\Facades\Gate;

class EnrollmentController extends Controller
{
    public function __construct(protected EnrollmentService $service) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Enrollment::class);

        $perPage = (int) $request->query('per_page', 15);
        $enrollments = $this->service->getAllPaginated($perPage);

        return EnrollmentResource::collection($enrollments);
    }

    public function store(StoreEnrollmentRequest $request): EnrollmentResource
    {
        Gate::authorize('create', Enrollment::class);

        return new EnrollmentResource($this->service->create($request->validated()));
    }

    public function show(int $id): EnrollmentResource
    {
        $enrollment = $this->service->getById($id);
        Gate::authorize('view', $enrollment);

        return new EnrollmentResource($enrollment);
    }

    public function update(UpdateEnrollmentRequest $request, int $id): EnrollmentResource
    {
        $enrollment = $this->service->getById($id);
        Gate::authorize('update', $enrollment);

        $this->service->update($id, $request->validated());

        return new EnrollmentResource($this->service->getById($id));
    }

    public function destroy(int $id): Response
    {
        $enrollment = $this->service->getById($id);
        Gate::authorize('delete', $enrollment);

        $this->service->delete($id);

        return response()->noContent();
    }
}
