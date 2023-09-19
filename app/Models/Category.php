<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Enums\Status;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'slug',
        'type',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'images',
        'description',
        'slug',
        'type',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    // Scope for active categories
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for categories of a specific type
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessor for formatted category name
    public function getFormattedNameAttribute(): string
    {
        return ucfirst((string) $this->name);
    }

    // Mutator for category slug
    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('local_files');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('medium')
            ->performOnCollections('local_files')
            ->width(500)
            ->height(500)
            ->format('webp');
    }
}
