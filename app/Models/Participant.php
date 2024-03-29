<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Status;
use App\Traits\HasGlobalDate;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;
    use HasGlobalDate;
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'phone_number',
        'email',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone_number',
        'gender',
        'country',
        'birth_date',
        'date',
        'address',
        'city',
        'zip_code',
        'emergency_contact_name',
        'emergency_contact_phone_number',
        'health_informations',
        'medical_history',
        'taking_medications',
        'medication_allergies',
        'sensitivities',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function results(): HasMany
    {
        return $this->hasMany(RaceResult::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Custom Attribute
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    // Accessor for participant's age
    public function getAgeAttribute()
    {
        return now()->diffInYears($this->birth_date);
    }

    // Mutator for participant's birth date
    public function setBirthDateAttribute($value): void
    {
        $this->attributes['birth_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    // Mutator
    public function setHealthInformationsAttribute($value): void
    {
        // Perform any validations or formatting here
        $this->attributes['health_informations'] = $value;
    }
}
