<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): bool
    {
        return $model ? $model->update($data) : false;
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function delete(Model $model): bool
    {
        return $model ? $model->delete() : false;
    }
}