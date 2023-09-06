<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\Status;
use App\Traits\HasGlobalDate;

class RaceLocation extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasAdvancedFilter;
    use HasGlobalDate;

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
        'status' => Status::class,
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->performOnCollections('local_files')
            ->width(1000)
            ->height(1000)
            ->format('webp');
    }
}
