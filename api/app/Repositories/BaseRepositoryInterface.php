<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();

    public function save(array $data);

    public function update(Model $model, array $data);

    public function find(int $id);

    public function delete(Model $model);
}
