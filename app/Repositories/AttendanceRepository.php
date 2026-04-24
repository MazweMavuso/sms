<?php

namespace App\Repositories;

use App\Models\Attendance;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceRepository extends BaseRepository
{
    public function __construct(Attendance $attendance)
    {
        parent::__construct($attendance);
    }

    public function paginateWithRelations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with(['student', 'subject'])->paginate($perPage);
    }
}
