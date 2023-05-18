<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'race_location_id',
        'category_id',
        'number_of_days',
        'number_of_racers',
        'price',
        'images',
        'social_media',
        'sponsors',
        'course',
        'features',
        'options',
        'status',
    ];

    protected $casts = [
        'options'  => 'json',
        'features' => 'json',
        // 'satuts' => RaceStatus::class,
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

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Custom Attribute
    public function getFullPriceAttribute()
    {
        // Perform any calculations or formatting here
        return number_format($this->price, 2).'DH';
    }

    // Mutator
    public function setImagesAttribute($value)
    {
        // Convert the images to JSON before saving
        $this->attributes['images'] = json_encode($value);
    }

    // Scope for races happening in the future
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>', now());
    }

    // Accessor for formatted race date
    public function getFormattedDateAttribute()
    {
        return $this->date->format('Y-m-d');
    }

    // Mutator for race date
    public function setFormattedDateAttribute($value)
    {
        $this->attributes['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
    }
}
