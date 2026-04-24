<?php

namespace App\Repositories;

use App\Models\Subject;
use Illuminate\Pagination\LengthAwarePaginator;

class SubjectRepository extends BaseRepository
{
    public function __construct(Subject $subject)
    {
        parent::__construct($subject);
    }

    public function paginateWithRelations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with(['teacher', 'enrollments', 'attendances'])->paginate($perPage);
    }
}
