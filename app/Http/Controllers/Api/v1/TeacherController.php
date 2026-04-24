<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreTeacherRequest;
use App\Http\Requests\Api\v1\UpdateTeacherRequest;
use App\Http\Resources\Api\v1\TeacherResource;
use App\Services\TeacherService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TeacherController extends Controller
{
    public function __construct(protected TeacherService $service) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = (int) $request->query('per_page', 15);
        $teachers = $this->service->getAllPaginated($perPage);

        return TeacherResource::collection($teachers);
    }

    public function store(StoreTeacherRequest $request): TeacherResource
    {
        return new TeacherResource($this->service->create($request->validated()));
    }

    public function show(int $id): TeacherResource
    {
        return new TeacherResource($this->service->getById($id));
    }

    public function update(UpdateTeacherRequest $request, int $id): TeacherResource
    {
        $this->service->update($id, $request->validated());

        return new TeacherResource($this->service->getById($id));
    }

    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
