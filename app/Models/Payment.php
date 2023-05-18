<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'user_id',
        'race_id',
        'amount',
        'payment_method',
        'status',
        'date',
    ];

    protected $casts = [
        // 'satuts' => PaymentStatus::class,
    ];

    // Define the relationship with the Participant model
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Race model
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    // Scope to filter payments by participant
    public function scopeByParticipant($query, $participantId)
    {
        return $query->where('participant_id', $participantId);
    }

    // Scope to filter payments by payment method
    public function scopeByPaymentMethod($query, $paymentMethod)
    {
        return $query->where('payment_method', $paymentMethod);
    }
}
