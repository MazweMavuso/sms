<?php

namespace App\Services;

use App\Repositories\SubjectRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class SubjectService extends BaseService
{
    public function __construct(SubjectRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithRelations($perPage);
    }
}
