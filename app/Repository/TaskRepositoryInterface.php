<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TaskRepositoryInterface extends EloquentRepositoryInterface
{
    public function findAllByProjectId(int $projectId): Collection;
}
