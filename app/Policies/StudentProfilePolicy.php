<?php

namespace App\Policies;

use App\Models\StudentProfile;
use App\Models\User;

class StudentProfilePolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function view(User $user, StudentProfile $studentProfile): bool
    {
        // Own profile
        if ($user->id === $studentProfile->user_id) {
            return true;
        }

        // Parent viewing child profile
        if ($user->isParent() && $user->children()->where('student_id', $studentProfile->user_id)->exists()) {
            return true;
        }

        // Teacher viewing student profile
        if ($user->isTeacher()) {
            // Should ideally check if teacher teaches this student, but for simplicity:
            return true;
        }

        return false;
    }

    public function update(User $user, StudentProfile $studentProfile): bool
    {
        return $user->isAdmin();
    }
}
