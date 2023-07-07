<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class RaceLocation extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'name',
        'category_id',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'description',
        'images',
        'options',
        'date',
        'latitude',
        'longitude',
        'category_id',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope for locations with a specific category
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
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
            ->performOnCollections('local_files')
            ->withResponsiveImages()
            ->format('webp');
    }
}
