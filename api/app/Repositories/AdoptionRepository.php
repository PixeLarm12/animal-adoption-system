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

    public function find(int $id): ?Adoption
    {
        return Adoption::where('id',$id)->with(['user','animal'])->firstOrFail();
    }

    public function getFormSelectOptions(): array
    {
        $animalRepository = new AnimalRepository(new Animal());
        $userRepository = new UserRepository(new User());

        return [
            "adoptionsStatusOptions" => $this->getAdoptionStatus(),
            "peopleOptions" => $userRepository->all(),
            "animalsOptions" => $animalRepository->getAnimalsAbleToAdopt(),
        ];
    }

    public function getAdoptionStatus(): array
    {
        return Adoption::getAdoptionStatus();
    }
}
