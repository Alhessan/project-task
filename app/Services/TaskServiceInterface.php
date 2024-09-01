<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TaskServiceInterface
{
    public function all(): Collection;
    public function create(array $data): Model;
    public function find(int $id): ?Model;
    public function update(int $id, array $data): ?Model;
    public function delete(int $id): bool;
    public function findByProjectId(int $projectId): Collection;
}
