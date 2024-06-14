<?php

namespace App\Repositories;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;

class AnimalRepository extends BaseRepository
{
    public function __construct(Animal $model) {
        parent::__construct($model);
    }

    public function getAnimalsAbleToAdopt($animalId = -1): Collection
    {
        $animalsToAdopt = Animal::ableToAdopt()->get();

        if($animalId != -1) {
            $actualAnimal = $this->find($animalId);

            if($actualAnimal)
                $animalsToAdopt->push($actualAnimal);
        }

        return $animalsToAdopt;
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

        return $animal;
    }

    public function updateAndSync(Animal $animal, array $data)
    {
        $animal->update($data);

        $animal->vaccines()->delete();

        if($data["vaccines"]) {
            $animal->vaccines()->createMany($data['vaccines']);
        }

        $animal->medicalInformations()->delete();

        if($data["medical_informations"]) {
            $animal->medicalInformations()->createMany($data['medical_informations']);
        }

        return $animal;
    }

    public function getFormSelectOptions(): array
    {
        return [
            "speciesOptions" => $this->getSpecies(),
        ];
    }

    public function getSpecies(): array
    {
        return Animal::getSpecies();
    }
}
