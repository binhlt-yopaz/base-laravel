<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return Collection|static[]
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * @param $paginate
     * @return mixed
     */
    public function getWithPagination($paginate)
    {
        return $this->_model->paginate($paginate);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Check if model exists
     * @param $id
     * @return mixed
     */
    public function exists($id)
    {
        return $this->_model->exists($id);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        $result = $this->_model->findOrFail($id);

        return $result;
    }

    /**
     * Get first
     * @return mixed
     */
    public function firstOrFail()
    {
        $result = $this->_model->firstOrFail();

        return $result;
    }

    /**
     * @param $where
     * @return mixed
     */
    public function filter($where)
    {
        $result = $this->_model->where($where)->get();
        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     * @throws \Exception
     */
    public function create(array $attributes)
    {
        try {
            return $this->_model->create($attributes);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * Create all
     * @param array $attributes
     * @return mixed
     */
    public function createAll(array $attributes)
    {
        return $this->_model->insert($attributes);
    }

    /**
     * Count all record
     * @return mixed
     */
    public function countAll()
    {
        return $this->_model->count();
    }

    public function newQuery()
    {
        return clone $this->_model;
    }

    public function whereIn($field, $arr)
    {
        $result = $this->_model->whereIn($field, $arr)->get();
        return $result;
    }
}
