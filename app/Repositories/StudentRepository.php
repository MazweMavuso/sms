<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentRepository extends BaseRepository
{
    public function __construct(Student $student)
    {
        parent::__construct($student);
    }

    /**
     * Get all students with their enrollments and attendances eager loaded.
     */
    public function allWithRelations(): Collection
    {
        return $this->model
            ->with(['enrollments', 'attendances'])
            ->get();
    }

    /**
     * Paginate students with eager loaded relations.
     */
    public function paginateWithRelations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->with(['enrollments', 'attendances'])
            ->paginate($perPage);
    }
}
