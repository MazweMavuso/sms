<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreUserRequest;
use App\Http\Requests\Api\v1\UpdateUserRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = (int) $request->query('per_page', 15);
        $users = $this->service->getAllPaginated($perPage);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $user = $this->service->createUserWithProfile($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): UserResource
    {
        $user = $this->service->getById($id);

        if (! $user) {
            abort(404, 'User not found');
        }

        return new UserResource($user->load(['role', 'teacherProfile', 'studentProfile', 'parentProfile', 'adminProfile']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id): UserResource
    {
        $this->service->updateUserWithProfile($id, $request->validated());
        $user = $this->service->getById($id);

        return new UserResource($user->load(['role', 'teacherProfile', 'studentProfile', 'parentProfile', 'adminProfile']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): Response
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
