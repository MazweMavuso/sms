<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreParentRequest;
use App\Http\Requests\Api\v1\UpdateParentRequest;
use App\Http\Resources\Api\v1\ParentResource;
use App\Services\ParentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ParentController extends Controller
{
    public function __construct(protected ParentService $service) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = (int) $request->query('per_page', 15);
        $parents = $this->service->getAllPaginated($perPage);

        return ParentResource::collection($parents);
    }

    public function store(StoreParentRequest $request): ParentResource
    {
        $data = $request->validated();
        $parent = $this->service->create($data);

        if (isset($data['students'])) {
            $parent->students()->sync($data['students']);
        }

        return new ParentResource($parent->load('students'));
    }

    public function show(int $id): ParentResource
    {
        $parent = $this->service->getById($id);

        return new ParentResource($parent->load('students'));
    }

    public function update(UpdateParentRequest $request, int $id): ParentResource
    {
        $data = $request->validated();
        $this->service->update($id, $data);
        $parent = $this->service->getById($id);

        if (isset($data['students'])) {
            $parent->students()->sync($data['students']);
        }

        return new ParentResource($parent->load('students'));
    }

    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
