<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProjectServiceInterface
{
    public function all(): Collection;
    public function create(array $data): Model;
    public function find(int $id): ?Model;
    public function update(int $id, array $data): ?Model;
    public function delete(int $id): bool;
}
