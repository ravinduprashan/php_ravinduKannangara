<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $query = $this->model->all();
        return $query;
    }

    public function getById($id)
    {
        return $this->newQuery()->findOrFail($id);
    }

    public function create(array $attributes): Model
    {
        return $this->newQuery()->create($attributes);
    }

    public function update(array $attributes, int $id): Int
    {
        return $this->getById($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function newQuery(): Builder
    {
        return $this->model->newQuery();
    }

    public function getUserById($id)
    {
        return $this->model::find($id);
    }

}