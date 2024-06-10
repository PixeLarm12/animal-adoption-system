<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalInformation extends Model
{
    protected $table = 'medical_informations';

    protected $fillable = [
        'animal_id',
        'description',
    ];

    public function animals(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
