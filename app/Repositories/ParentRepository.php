<?php

namespace App\Repositories;

use App\Models\ParentModel;
use Illuminate\Pagination\LengthAwarePaginator;

class ParentRepository extends BaseRepository
{
    public function __construct(ParentModel $parent)
    {
        parent::__construct($parent);
    }

    public function paginateWithRelations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with('students')->paginate($perPage);
    }
}
