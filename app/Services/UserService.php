<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithRelations($perPage);
    }

    public function createUserWithProfile(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = $this->repository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'],
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
            ]);

            $this->syncProfile($user, $data);

            return $user->load(['role', 'teacherProfile', 'studentProfile', 'parentProfile', 'adminProfile']);
        });
    }

    public function updateUserWithProfile(int $id, array $data): bool
    {
        return DB::transaction(function () use ($id, $data) {
            $user = $this->repository->find($id);
            if (! $user) {
                return false;
            }

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);
            $this->syncProfile($user, $data);

            return true;
        });
    }

    protected function syncProfile(User $user, array $data): void
    {
        $roleSlug = $user->role->slug;

        match ($roleSlug) {
            'teacher' => $user->teacherProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'subject' => $data['subject'] ?? null,
                    'employee_no' => $data['employee_no'] ?? null,
                    'department' => $data['department'] ?? null,
                ]
            ),
            'student' => $user->studentProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'grade' => $data['grade'] ?? null,
                    'admission_no' => $data['admission_no'] ?? null,
                    'parent_id' => $data['parent_id'] ?? null,
                    'date_of_birth' => $data['date_of_birth'] ?? null,
                ]
            ),
            'parent' => $user->parentProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'occupation' => $data['occupation'] ?? null,
                ]
            ),
            'admin' => $user->adminProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'position' => $data['position'] ?? null,
                    'access_level' => $data['access_level'] ?? null,
                ]
            ),
            default => null,
        };
    }
}
