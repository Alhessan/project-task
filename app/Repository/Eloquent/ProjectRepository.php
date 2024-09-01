<?php

namespace App\Repository\Eloquent;


use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function findAllByStatus($status): Collection
    {
        return $this->model->where('status', $status)->get();
    }

}
