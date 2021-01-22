<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class AbstractRepository
{
    /**
     * Repository model
     *
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     *
     * @param Model $model
     */
    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Return all records from database
     *
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create a new record for the database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Updates a record in the database
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    /**
     * Destroys a record from the database
     *
     * @param $id
     * @return int
     */
    public function delete($id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * Finds a record on the database, if it does not exist it throws an exception
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        if (null == $post = $this->model->find($id)) {
            throw new ModelNotFoundException("Post not found");
        }

        return $post;
    }
}
