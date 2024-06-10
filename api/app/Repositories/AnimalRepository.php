<?php

namespace App\Repositories;

use App\Models\Animal;

class AnimalRepository extends BaseRepository
{
    public function __construct(Animal $model) {
        parent::__construct($model);
    }

    public function save(array $data): Animal
    {
        $animal = Animal::create($data);

        if($data['vaccines']) {
            $animal->vaccines()->createMany($data['vaccines']);
        }

        if($data['medical_informations']) {
            $animal->medicalInformations()->createMany($data['medical_informations']);
        }

        return $animal->with(["vaccines", "medicalInformations"]);
    }
}
