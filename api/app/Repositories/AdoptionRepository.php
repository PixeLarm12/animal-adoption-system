<?php

namespace App\Repositories;

use App\Models\Adoption;

class AdoptionRepository extends BaseRepository
{
    public function __construct(Adoption $model) {
        parent::__construct($model);
    }

    public function getAdoptionStatus(): array
    {
        return Adoption::getAdoptionStatus();
    }
}
