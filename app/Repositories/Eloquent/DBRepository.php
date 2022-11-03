<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class DBRepository
{
    /**
     * Eloquent model.
     */
    protected $model;

    /**
     * @param mixed $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function allOrEmpty($columns = ['*'])
    {
        $data = $this->model->all($columns);
        $data = $data->isNotEmpty() ? $data->toArray() : [];

        return $data;
    }

    public function paginate($per = 10)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($per);
    }

    public function pluck($column, $key = null, $sortColumn = null, $direction = 'asc')
    {
        return $this->model->orderBy($sortColumn, $direction)->pluck($column, $key);
    }

    public function findById($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update(Model $model, $attributes = [])
    {
        return $model->fill($attributes)->save();
    }

    public function updateColumn($id, $columns, $data)
    {
        return $this->model->where(['id' => $id])->update([$columns => $data]);
    }

    public function destroy($id)
    {
        $obj = $this->model->findOrFail($id);

        return $obj->delete();
    }

    public function findBy($key, $value, $withTrashed = false)
    {
        return !$withTrashed ? $this->model->where($key, $value)->first() : $this->model->where($key, $value)->withTrashed()->first();
    }

    public function findAllBy($key, $value, $columns = '*', $isPaginate = false, $per = 10)
    {
        $query = $this->model->where($key, $value)->select($columns)->orderBy('id', 'desc');

        return !$isPaginate ? $query->get() : $query->paginate($per);
    }

    public function findAllWhereIn($key, $values, $columns = '*', $isPaginate = false, $per = 10)
    {
        $query = $this->model->whereIn($key, $values)->select($columns)->orderBy('id', 'desc');

        return !$isPaginate ? $query->get() : $query->paginate($per);
    }

    public function destroyByConditions($conditions)
    {
        $query = $this->model;

        foreach ($conditions as $key => $value) {
            $query = $query->where($key, $value);
        }

        $obj = $query->first();

        return $obj ? $obj->delete() : false;
    }

    public function restore($id)
    {
        $obj = $this->model->withTrashed()->findOrFail($id);

        return $obj->restore();
    }

    public function exists($key, $value, $withTrashed = false)
    {
        return !$withTrashed ? $this->model->where($key, $value)->exists() : $this->model->where($key, $value)->withTrashed()->exists();
    }

    public function updateWhereIn($key, array $values, $updateData)
    {
        return $this->model->whereIn($key, $values)->update($updateData);
    }

    public function insertGetId($data)
    {
        return $this->model->insertGetId($data);
    }

    public function insert($data)
    {
        return $this->model->insert($data);
    }

    public function findByConditions($conditions = [])
    {
        $query = $this->model;

        foreach ($conditions as $key => $value) {
            $query = $query->where($key, $value);
        }

        $obj = $query->first();

        return $obj;
    }
}
