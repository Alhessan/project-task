<?php

namespace App\Repository\Eloquent;

use App\Repository\Eloquent\id;
use App\Repository\Eloquent\Post;
use App\Repository\EloquentRepositoryInterface;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Get all Model records.
     *
     * @return Post $post
     */
    public function all(): Collection
    {
        return $this->model
            ->get();
    }

    /**
     * Update Model
     *
     * @param id
     * @param $data array
     * @return Model
     */
    public function update($id, array $data): Model
    {
        $model = $this->model->find($id)->update($data);
        return $model;
    }

    /**
     * save Model
     *
     * @param id
     * @param $data array
     * @return Model
     */
    public function save(array $data): Model
    {

        try {
            if (isset($data['id'])) {
                $id = intval($data['id']);
                $model = $this->model->find($id);
                if(! $model->update($data)){
                    throw new InvalidArgumentException(__('messages.failed to store'));
                }
            } else {
                $model = $this->model->create($data);
            }
            return $model;
        } catch (\Exception $e) {
            throw new \InvalidArgumentException(__('messages.failed to store'));
        }
    }

    /**
     * Delete Model
     *
     * @param $data
     * @return Post
     */
    public function delete($id):bool
    {
        $model = $this->model->find($id);
        return  $model->delete();
    }

}
