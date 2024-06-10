<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $table = "addresses";

    protected $fillable = [
        'street',
        'number',
        'zipcode',
        'neighborhood',
        'complement',
        'person_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'person_id');
    }
}
