<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentService extends BaseService
{
    public function __construct(StudentRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get all students with eager loaded relations and paginate the result.
     *
     * This method delegates the pagination logic to the repository, which
     * encapsulates the query and respects the repository's protected model
     * property.
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        // Use the repository method that handles eager loading and pagination.
        return $this->repository->paginateWithRelations($perPage);
    }
}
