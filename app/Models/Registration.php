<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Registration extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    protected $fillable = [
        'participant_id',
        'race_id',
        'order_id',
        'registration_date',
        'status',
        'date',
        'additional_informations',
        'additional_services',
        'uuid',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    // Scope to filter registrations by participant
    public function scopeByParticipant($query, $participantId)
    {
        return $query->where('participant_id', $participantId);
    }

    // Scope to filter registrations by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
