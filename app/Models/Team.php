<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'leader_id'];

    public function leader()
    {
        return $this->belongsTo(Participant::class, 'leader_id');
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
}
