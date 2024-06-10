<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    protected $table = "phones";

    protected $fillable = [
        'area',
        'phone',
        'person_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'person_id');
    }
}
