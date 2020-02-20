<?php

namespace App\Repositories;

use App\Models\Model;
use Illuminate\Support\Collection;

abstract class Repository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param $model Model
     */
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * Get number of records
     */
    public function getNumber()
    {
        return $this->model->count();
    }

    /**
     * Update columns in the record by id.
     *
     * @param $id
     * @param $input
     * @return bool
     */
    public function updateColumn($id, $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }

    /**
     * Destroy a model.
     *
     * @param  $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Get model by id.
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get all the records
     *
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * Get number of the records
     *
     * @param int $limit
     * @param  string $sort
     * @param  string $sortColumn
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function page($limit = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        return $this->model->orderBy($sortColumn, $sort)->paginate($limit);
    }

    /**
     * @param string $field
     * @param null|string $value
     * @param int $limit
     * @param string $sort
     * @param string $sortColumn
     * @return Collection
     */
    public function findAllByField(string $field, string $value = null, $limit = 10, $sort = 'desc', $sortColumn = 'id')
    {
        $result = $this->model;

        if ($value) {
            $result = $result->where($field, 'like', '%' . $value . '%');
        }

        return $result->orderBy($sortColumn, $sort)->paginate($limit);
    }

    /**
     * Store a new record.
     *
     * @param  $input
     * @return mixed
     */
    public function store($input)
    {
        return $this->save($this->model, $input);
    }

    /**
     * Update a record by id.
     *
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);

        return $this->save($this->model, $input);
    }

    /**
     * Save the input's data.
     *
     * @param  $model Model
     * @param  $input
     * @return mixed
     */
    public function save($model, $input)
    {
        $model->fill($input);

        $model->save();

        return $model;
    }
}
