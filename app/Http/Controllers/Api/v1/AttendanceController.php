<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreAttendanceRequest;
use App\Http\Requests\Api\v1\UpdateAttendanceRequest;
use App\Http\Resources\Api\v1\AttendanceResource;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AttendanceController extends Controller
{
    public function __construct(protected AttendanceService $service) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = (int) $request->query('per_page', 15);
        $attendances = $this->service->getAllPaginated($perPage);

        return AttendanceResource::collection($attendances);
    }

    public function store(StoreAttendanceRequest $request): AttendanceResource
    {
        return new AttendanceResource($this->service->create($request->validated()));
    }

    public function show(int $id): AttendanceResource
    {
        return new AttendanceResource($this->service->getById($id));
    }

    public function update(UpdateAttendanceRequest $request, int $id): AttendanceResource
    {
        $this->service->update($id, $request->validated());

        return new AttendanceResource($this->service->getById($id));
    }

    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
