<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Gloudemans\Shoppingcart\CanBeBought;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use App\Enums\RaceStatus;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasUuid;

class Race extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use HasUuid;
    use CanBeBought;

    public const ATTRIBUTES = [
        'id',
        'name',
        'status',
        'date',
        'race_location_id',
        'category_id',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'description',
        'date',
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
        'date'         => 'date',
    ];

    public function location()
    {
        return $this->belongsTo(RaceLocation::class, 'race_location_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getFullPriceAttribute()
    {
        return number_format($this->price, 2).'DH';
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>', now());
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('date', date('Y'));
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('date', date('Y'))
            ->whereMonth('date', date('m'));
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getNumberOfParticipantsAttribute()
    {
        return $this->registrations()->count();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('local_files');
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('large')
            ->width(1000)
            ->height(1000)
            ->quality(90)
            ->performOnCollections('local_files')
            ->format('webp');
    }

    // Race History
    // Is this the first year for your race? *
    // Yes No
    // URL For Last Year’s Event
}
