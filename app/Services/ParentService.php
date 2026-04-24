<?php

namespace App\Services;

use App\Repositories\ParentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ParentService extends BaseService
{
    public function __construct(ParentRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithRelations($perPage);
    }
}
