<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Gloudemans\Shoppingcart\CanBeBought;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Enums\RaceStatus;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use HasUuid;
    use CanBeBought;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'status',
        'race_location_id',
        'category_id',
        'start_registration',
        'end_registration',
        'registration_deadline',
        'created_at',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'description',
        'race_location_id',
        'category_id',
        'start_registration',
        'end_registration',
        'registration_deadline',
        'number_of_days',
        'elevation_gain',
        'content',
        'number_of_racers',
        'first_year',
        'last_year_url',
        'price',
        'images',
        'social_media',
        'sponsors',
        'course',
        'features',
        'options',
        'status',
        'calendar',
    ];

    protected $casts = [
        'options'      => 'json',
        'features'     => 'json',
        'social_media' => 'json',
        'sponsors'     => 'json',
        'calendar'     => 'json',
        'course'       => 'json',
        'satuts'       => RaceStatus::class,
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(RaceLocation::class, 'race_location_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('local_files');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->performOnCollections('local_files')
            ->width(1000)
            ->height(1000)
            ->quality(90)
            ->format('webp');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_registration', '>', now());
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('start_registration', date('Y'));
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('start_registration', date('Y'))
            ->whereMonth('start_registration', date('m'));
    }

    public function getNumberOfParticipantsAttribute()
    {
        return $this->registrations()->count();
    }

    public function getRegistrationOrdersTotalAttribute()
    {
    }

    public function getTotalOrdersAttribute()
    {
        return $this->orders()->count();
    }
}
