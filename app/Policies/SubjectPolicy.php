<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
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

    public function view(User $user, Subject $subject): bool
    {
        return true; // Everyone can see subjects? Or restrict to enrolled students?
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Subject $subject): bool
    {
        return $user->isAdmin() || ($user->isTeacher() && $subject->teacher_id === $user->id);
    }

    public function delete(User $user, Subject $subject): bool
    {
        return $user->isAdmin();
    }
}
