<?php

namespace App\Repositories;

use App\Models\Animal;

class AnimalRepository extends BaseRepository
{
    public function __construct(Animal $model) {
        parent::__construct($model);
    }
}
