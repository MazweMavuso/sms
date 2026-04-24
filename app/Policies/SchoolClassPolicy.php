<?php

namespace App\Policies;

use App\Models\SchoolClass;
use App\Models\User;

class SchoolClassPolicy
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

    public function view(User $user, SchoolClass $schoolClass): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, SchoolClass $schoolClass): bool
    {
        return $user->isAdmin() || ($user->isTeacher() && $schoolClass->teacher_id === $user->id);
    }

    public function delete(User $user, SchoolClass $schoolClass): bool
    {
        return $user->isAdmin();
    }
}
