<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Animal extends Model
{
    const ANIMAL_SEX_FEMALE = 'f';
    const ANIMAL_SEX_MALE = 'm';

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


    public function scopeAbleToAdopt($query)
    {
        return $query->doesntHave('adoption');
    }

    public function adoption(): HasOne
    {
        return $this->hasOne(Adoption::class, 'animal_id');
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

    public static function getSpecies()
    {
        return [
            [
                "key" => self::ANIMAL_SPECIE_DOG,
                "label" => ucfirst(self::ANIMAL_SPECIE_DOG),
            ],
            [
                "key" => self::ANIMAL_SPECIE_CAT,
                "label" => ucfirst(self::ANIMAL_SPECIE_CAT),
            ],
            [
                "key" => self::ANIMAL_SPECIE_BIRD,
                "label" => ucfirst(self::ANIMAL_SPECIE_BIRD),
            ],
            [
                "key" => self::ANIMAL_SPECIE_FISH,
                "label" => ucfirst(self::ANIMAL_SPECIE_FISH),
            ],
            [
                "key" => self::ANIMAL_SPECIE_LIZARD,
                "label" => ucfirst(self::ANIMAL_SPECIE_LIZARD),
            ],
        ];
    }
}
