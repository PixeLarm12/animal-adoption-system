<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaccine extends Model
{
    protected $table = 'vaccines';

    protected $fillable = [
        'animal_id',
        'title',
        'date',
        'next',
        'description',
    ];

    public function animals(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
