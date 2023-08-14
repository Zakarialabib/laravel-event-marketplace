<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\Status;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id', 'name', 'slug', 'status'
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name', 'description', 'image', 'slug', 'status', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function scopeActive($query): void
    {
        $query->where('status', 1);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('local_files');
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('large')
            ->width(500)
            ->height(500)
            ->performOnCollections('local_files')
            ->format('webp');
    }
}
