<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Return all records from database
     *
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all();

    /**
     * Create a new record for the database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Updates a record in the database
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * Destroys a record from the database
     *
     * @param $id
     * @return int
     */
    public function delete($id): int;

    /**
     * Finds a record on the database, if it does not exist it throws an exception
     *
     * @param $id
     * @return mixed
     */
    public function find($id);
}
