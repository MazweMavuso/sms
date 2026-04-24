<?php

namespace App\Repositories;

use App\Models\Enrollment;
use Illuminate\Pagination\LengthAwarePaginator;

class EnrollmentRepository extends BaseRepository
{
    public function __construct(Enrollment $enrollment)
    {
        parent::__construct($enrollment);
    }

    public function paginateWithRelations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with(['student', 'subject'])->paginate($perPage);
    }
}
