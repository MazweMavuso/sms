<?php

use App\Http\Controllers\Api\v1\AttendanceController;
use App\Http\Controllers\Api\v1\EnrollmentController;
use App\Http\Controllers\Api\v1\ParentController;
use App\Http\Controllers\Api\v1\SchoolClassController;
use App\Http\Controllers\Api\v1\StudentController;
use App\Http\Controllers\Api\v1\SubjectController;
use App\Http\Controllers\Api\v1\TeacherController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('school-classes', SchoolClassController::class);
    Route::apiResource('enrollments', EnrollmentController::class);
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('parents', ParentController::class);
});
