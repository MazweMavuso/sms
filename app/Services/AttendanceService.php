<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceService extends BaseService
{
    public function __construct(AttendanceRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithRelations($perPage);
    }
}
