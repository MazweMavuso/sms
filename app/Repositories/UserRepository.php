<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function paginateWithRelations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with([
            'role',
            'teacherProfile',
            'studentProfile',
            'parentProfile',
            'adminProfile',
        ])->paginate($perPage);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function findWithRelations(int $id): ?User
    {
        return $this->model->with([
            'role',
            'teacherProfile',
            'studentProfile',
            'parentProfile',
            'adminProfile',
        ])->find($id);
    }
}
