<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreSubjectRequest;
use App\Http\Requests\Api\v1\UpdateSubjectRequest;
use App\Http\Resources\Api\v1\SubjectResource;
use App\Services\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function __construct(protected SubjectService $service) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = (int) $request->query('per_page', 15);
        $subjects = $this->service->getAllPaginated($perPage);

        return SubjectResource::collection($subjects);
    }

    public function store(StoreSubjectRequest $request): SubjectResource
    {
        return new SubjectResource($this->service->create($request->validated()));
    }

    public function show(int $id): SubjectResource
    {
        return new SubjectResource($this->service->getById($id));
    }

    public function update(UpdateSubjectRequest $request, int $id): SubjectResource
    {
        $this->service->update($id, $request->validated());

        return new SubjectResource($this->service->getById($id));
    }

    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
