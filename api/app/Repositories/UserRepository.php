<?php

namespace App\Repositories;

use App\Models\Phone;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model) {
        parent::__construct($model);
    }

    public function save(array $data): User
    {
        $user = User::create($data);

        if($data['phones']) {
            $user->phones()->createMany($data['phones']);
        }

        if($data['addresses']) {
            $user->addresses()->createMany($data['addresses']);
        }

        return $user;
    }
}
