<?php

namespace App\Repositories;

use App\Models\Teacher;
use Illuminate\Pagination\LengthAwarePaginator;

class TeacherRepository extends BaseRepository
{
    public function __construct(Teacher $teacher)
    {
        parent::__construct($teacher);
    }

    public function paginateWithRelations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with('courses')->paginate($perPage);
    }
}
