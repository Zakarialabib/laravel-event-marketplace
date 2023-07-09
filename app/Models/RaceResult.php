<?php

declare(strict_types=1);

namespace App\Models;

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
        'title',
        'category_id',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'race_id',
        'winner_id',
        'runner_up_id',
        'place',
        'time',
        'date',
        'status',
    ];

    // Define the relationship with the Race model
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    // Define the relationship with the Participant model for winner
    public function winner()
    {
        return $this->belongsTo(Participant::class, 'winner_id');
    }

    // Define the relationship with the Participant model for runner-up
    public function runnerUp()
    {
        return $this->belongsTo(Participant::class, 'runner_up_id');
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
