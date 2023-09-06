<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use App\Traits\HasGlobalDate;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;
    use HasGlobalDate;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'participant_id',
        'race_id',
        'registration_date',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'participant_id',
        'race_id',
        'order_id',
        'team_id',
        'registration_number',
        'registration_date',
        'status',
        'date',
        'additional_informations',
        'additional_services',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'race_id');
    }

    public function result(): HasOne
    {
        return $this->hasOne(RaceResult::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope to filter registrations by participant
    public function scopeByParticipant($query, $participantId)
    {
        return $query->where('participant_id', $participantId);
    }
}
