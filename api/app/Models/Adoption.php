<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $appends = [
        'animal_name_append',
        'person_name_append',
        'status_formatted',
    ];

    public function getAnimalNameAppendAttribute() {
        $animal = $this->animal;

        return $animal->name;
    }

    public function getPersonNameAppendAttribute() {
        $user = $this->user;

        return $user->name;
    }

    public function getStatusFormattedAttribute() {
        $status = self::getStatusByKey($this->attributes['status']);

        return $status ? $status['label'] : "";
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->animal->update([
                'adoption_status' => $model->status,
            ]);
        });

        self::updated(function ($model) {
            $model->animal->update([
                'adoption_status' => $model->status,
            ]);
        });

        self::deleted(function ($model) {
            $model->animal->update([
                'adoption_status' => self::ADOPTION_STATUS_NOT_STARTED,
            ]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'person_id', 'id');
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'animal_id', 'id');
    }

    public static function getStatusByKey($key)
    {
        $status = self::getAdoptionStatus();

        foreach($status as $el) {
            if($el['key'] == $key) {
                return $el;
            }
        }
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
