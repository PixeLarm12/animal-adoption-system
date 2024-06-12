<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Adoption extends Model
{
    const ADOPTION_STATUS_NOT_STARTED = 'not_started';
    const ADOPTION_STATUS_PROCESSING = 'processing';
    const ADOPTION_STATUS_ACCEPTED = 'accepted';
    const ADOPTION_STATUS_NOT_ACCEPTED = 'not_accepted';

    protected $table = 'adoptions';

    protected $fillable = [
        'animal_id',
        'person_id',
        'status',
        'adoption_date',
        'observation',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'person_id');
    }

    public function animal(): HasOne
    {
        return $this->hasOne(Animal::class);
    }

    public static function getAdoptionStatus()
    {
        return [
            [
                "key" => self::ADOPTION_STATUS_NOT_STARTED,
                "label" => "Not started",
            ],
            [
                "key" => self::ADOPTION_STATUS_PROCESSING,
                "label" => "Processing",
            ],
            [
                "key" => self::ADOPTION_STATUS_ACCEPTED,
                "label" => "Accepted",
            ],
            [
                "key" => self::ADOPTION_STATUS_NOT_ACCEPTED,
                "label" => "Not accepted",
            ],
        ];
    }
}
