<?php

namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProjectRepositoryInterface extends EloquentRepositoryInterface
{
    public function findAllByStatus($status): Collection;
}
