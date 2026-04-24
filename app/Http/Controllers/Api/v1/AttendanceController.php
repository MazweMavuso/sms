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

use App\Models\Attendance;
use Illuminate\Support\Facades\Gate;

use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class AttendanceController extends Controller
{
    public function __construct(protected AttendanceService $service) {}

    public function index(Request $request): JsonResponse
    {
        Gate::authorize('viewAny', Attendance::class);

        $perPage = (int) $request->query('per_page', 15);
        $attendances = $this->service->getAllPaginated($perPage);

        return ApiResponse::success(
            'Attendance records retrieved successfully.',
            AttendanceResource::collection($attendances)->response()->getData(true)
        );
    }

    public function store(StoreAttendanceRequest $request): JsonResponse
    {
        Gate::authorize('create', Attendance::class);

        $attendance = $this->service->create($request->validated());

        return ApiResponse::success(
            'Attendance record created successfully.',
            new AttendanceResource($attendance),
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $attendance = $this->service->getById($id);
        Gate::authorize('view', $attendance);

        return ApiResponse::success(
            'Attendance record retrieved successfully.',
            new AttendanceResource($attendance)
        );
    }

    public function update(UpdateAttendanceRequest $request, int $id): JsonResponse
    {
        $attendance = $this->service->getById($id);
        Gate::authorize('update', $attendance);

        $this->service->update($id, $request->validated());
        $attendance = $this->service->getById($id);

        return ApiResponse::success(
            'Attendance record updated successfully.',
            new AttendanceResource($attendance)
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $attendance = $this->service->getById($id);
        Gate::authorize('delete', $attendance);

        $this->service->delete($id);

        return ApiResponse::success('Attendance record deleted successfully.');
    }
}
