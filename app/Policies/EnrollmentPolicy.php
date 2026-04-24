<?php

namespace App\Policies;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EnrollmentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Enrollment $enrollment): bool
    {
        // Student viewing their own enrollment
        if ($user->id === $enrollment->student_id) {
            return true;
        }

        // Parent viewing their child's enrollment
        if ($user->isParent() && $user->children()->where('student_id', $enrollment->student_id)->exists()) {
            return true;
        }

        // Teacher viewing enrollment in their subject
        if ($user->isTeacher() && $enrollment->subject->teacher_id === $user->id) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Enrollment $enrollment): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Enrollment $enrollment): bool
    {
        return $user->isAdmin();
    }
}
