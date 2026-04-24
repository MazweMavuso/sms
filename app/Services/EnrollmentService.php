<?php

namespace App\Services;

use App\Repositories\EnrollmentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class EnrollmentService extends BaseService
{
    public function __construct(EnrollmentRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithRelations($perPage);
    }
}
