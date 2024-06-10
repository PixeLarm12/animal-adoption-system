<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    const ANIMAL_SEX_FEMALE = 'female';
    const ANIMAL_SEX_MALE = 'male';

    const ANIMAL_SPECIE_DOG = 'dog';
    const ANIMAL_SPECIE_CAT = 'cat';
    const ANIMAL_SPECIE_BIRD = 'bird';
    const ANIMAL_SPECIE_FISH = 'fish';
    const ANIMAL_SPECIE_LIZARD = 'lizard';

    protected $table = 'animals';

    protected $fillable = [
        'adoption_status',
        'name',
        'specie',
        'sex',
        'description',
        'entry_date',
        'birth_date',
    ];

    public function adoption(): BelongsTo
    {
        return $this->belongsTo(Adoption::class);
    }

    public function vaccines(): HasMany
    {
        return $this->hasMany(Vaccine::class);
    }

    public function medicalInformations(): HasMany
    {
        return $this->hasMany(MedicalInformation::class);
    }

    public function catalogs(): BelongsToMany
    {
        return $this->belongsToMany(Catalog::class, 'animals_catalogs', 'animal_id');
    }
}
