<?php

namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendancePolicy
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
        return true; // Filtering handled by repository/scopes
    }

    public function view(User $user, Attendance $attendance): bool
    {
        // Student viewing their own attendance
        if ($user->id === $attendance->student_id) {
            return true;
        }

        // Parent viewing their child's attendance
        if ($user->isParent() && $user->children()->where('student_id', $attendance->student_id)->exists()) {
            return true;
        }

        // Teacher viewing attendance for their subject
        if ($user->isTeacher() && $attendance->subject->teacher_id === $user->id) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isTeacher();
    }

    public function update(User $user, Attendance $attendance): bool
    {
        // Only the teacher of the subject or Admin can update
        return $user->isTeacher() && $attendance->subject->teacher_id === $user->id;
    }

    public function delete(User $user, Attendance $attendance): bool
    {
        return $user->isAdmin();
    }
}
