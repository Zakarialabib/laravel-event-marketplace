<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use App\Traits\HasGlobalDate;

class RaceResult extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use HasGlobalDate;

    public const ATTRIBUTES = [
        'id',
        'race_id',
        'participant_id',
        'registration_id',
        'place',
        'time',
        'date',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'race_id',
        'participant_id',
        'registration_id',
        'place',
        'time',
        'date',
        'status',
    ];

    protected $cast = [
        'status' => Status::class,
    ];


    // Define the relationship with the Race model
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    // Scope to filter race results by race
    public function scopeByRace($query, $raceId)
    {
        return $query->where('race_id', $raceId);
    }

    // Scope to filter race results by place
    public function scopeByPlace($query, $place)
    {
        return $query->where('place', $place);
    }
}
