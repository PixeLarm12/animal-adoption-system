<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'birth_date',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class, 'person_id', 'id');
    }

    public function address(): HasMany
    {
        return $this->hasMany(Address::class, 'person_id', 'id');
    }

    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class, 'person_id', 'id');
    }
}
