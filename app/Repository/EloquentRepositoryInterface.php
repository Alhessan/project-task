<?php


namespace App\Repository;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;
    /**
     * Get all Model records.
     *
     * @return Post $post
     */
    public function all(): Collection;

    /**
     * Get eloquent query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): \Illuminate\Database\Eloquent\Builder;
    /**
     * Update Model
     *
     * @param id
     * @param $data array
     * @return Model
     */
    public function update($id, array $data): Model;
    /**
     * Delete Model
     *
     * @param $data
     * @return Post
     */
    public function delete($id):bool;
}

