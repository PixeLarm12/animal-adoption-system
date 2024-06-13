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

    public function find(int $id): ?Animal
    {
        return Animal::where('id',$id)->with(['vaccines','medicalInformations'])->firstOrFail();
    }

    public function getAnimalsAbleToAdopt(): Collection
    {
        return Animal::ableToAdopt()->get();
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

    public function getFormSelectOptions(): array
    {
        $adoptionRepository = new AdoptionRepository(new Adoption());

        return [
            "speciesOptions" => $this->getSpecies(),
            "adoptionsStatusOptions" => $adoptionRepository->getAdoptionStatus(),
        ];
    }

    public function getSpecies(): array
    {
        return Animal::getSpecies();
    }
}
