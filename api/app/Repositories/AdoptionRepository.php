<?php

namespace App\Repositories;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;

class AdoptionRepository extends BaseRepository
{
    public function __construct(Adoption $model) {
        parent::__construct($model);
    }

    public function getFormSelectOptions($id = -1): array
    {
        $animalRepository = new AnimalRepository(new Animal());
        $userRepository = new UserRepository(new User());
        $adoption = new Adoption();

        if($id != -1)
            $adoption = $this->find($id);

        return [
            "adoptionsStatusOptions" => $this->getAdoptionStatus(),
            "peopleOptions" => $userRepository->all(),
            "animalsOptions" => $adoption->animal_id ? $animalRepository->getAnimalsAbleToAdopt($adoption->animal_id) : $animalRepository->getAnimalsAbleToAdopt(),
        ];
    }

    public function getAdoptionStatus(): array
    {
        return Adoption::getAdoptionStatus();
    }
}
