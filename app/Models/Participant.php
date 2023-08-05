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
class Participant extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;
    use HasGlobalDate;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'name',
        'phone_number',
        'email',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
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
        'has_medical_history',
        'is_taking_medications',
        'has_medication_allergies',
        'has_sensitivities',
        'health_information',
        'status',
        'race_location_id',
        'user_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function raceLocation()
    {
        return $this->belongsTo(RaceLocation::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    // Mutator
    public function setHealthInformationsAttribute($value)
    {
        // Perform any validations or formatting here
        $this->attributes['health_informations'] = $value;
    }
}
