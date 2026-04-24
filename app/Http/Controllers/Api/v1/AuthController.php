<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\LoginRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Authenticate a user and return a token.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ApiResponse::error('Invalid credentials.', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponse::success('Login successful.', [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user->load('role')),
        ]);
    }

    /**
     * Log the user out (Revoke the token).
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return ApiResponse::success('Logged out successfully.');
    }

    /**
     * Get the authenticated User.
     */
    public function me(Request $request): JsonResponse
    {
        return ApiResponse::success(
            'User profile retrieved successfully.',
            new UserResource($request->user()->load(['role', 'teacherProfile', 'studentProfile', 'parentProfile', 'adminProfile']))
        );
    }
}
