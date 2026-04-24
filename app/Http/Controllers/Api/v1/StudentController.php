<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreStudentRequest;
use App\Http\Requests\Api\v1\UpdateStudentRequest;
use App\Http\Resources\Api\v1\StudentResource;
use App\Services\StudentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function __construct(protected StudentService $service) {}

    public function index(): AnonymousResourceCollection
    {
        // Allow client to specify per_page query param, default 15.
        $perPage = (int) request()->query('per_page', 15);
        $paginator = $this->service->getAllPaginated($perPage);

        return StudentResource::collection($paginator);
    }

    public function store(StoreStudentRequest $request): StudentResource
    {
        return new StudentResource($this->service->create($request->validated()));
    }

    public function show(int $id): StudentResource
    {
        return new StudentResource($this->service->getById($id));
    }

    public function update(UpdateStudentRequest $request, int $id): StudentResource
    {
        $this->service->update($id, $request->validated());

        return new StudentResource($this->service->getById($id));
    }

    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
