<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'team_id', 'participant_id',
        'invitation_emails',
        'is_accepted',
        'invitation_sent_at',
        'status',
    ];

    protected $casts = [
        'is_accepted'        => 'boolean',
        'invitation_sent_at' => 'datetime',
        'invitation_emails'  => 'json',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
