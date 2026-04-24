<?php

namespace App\Services;

use App\Repositories\TeacherRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TeacherService extends BaseService
{
    public function __construct(TeacherRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithRelations($perPage);
    }
}
