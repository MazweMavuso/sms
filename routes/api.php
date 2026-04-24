<?php

use App\Http\Controllers\Api\v1\AttendanceController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\EnrollmentController;
use App\Http\Controllers\Api\v1\ParentController;
use App\Http\Controllers\Api\v1\SchoolClassController;
use App\Http\Controllers\Api\v1\StudentController;
use App\Http\Controllers\Api\v1\SubjectController;
use App\Http\Controllers\Api\v1\TeacherController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    
    // Public routes
    Route::post('/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        
        // Auth management
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Admin-only routes
        Route::middleware('role:admin')->group(function () {
            Route::apiResource('users', UserController::class);
            Route::apiResource('teachers', TeacherController::class);
            Route::apiResource('parents', ParentController::class);
            Route::apiResource('students', StudentController::class);
        });

        // Admin and Teacher routes
        Route::middleware('role:admin,teacher')->group(function () {
            Route::apiResource('school-classes', SchoolClassController::class);
            Route::apiResource('subjects', SubjectController::class);
        });

        // Routes shared by multiple roles, handled by Policies
        Route::apiResource('attendances', AttendanceController::class);
        Route::apiResource('enrollments', EnrollmentController::class);
    });
});
