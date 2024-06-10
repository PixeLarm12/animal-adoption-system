<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Catalog extends Model
{
    protected $table = 'catalogs';

    protected $fillable = [
        'title',
        'description',
    ];

    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animals_catalogs', 'catalog_id');
    }
}
