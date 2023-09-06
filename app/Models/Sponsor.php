<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use App\Support\HasAdvancedFilter;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\Status;

class Sponsor extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'name',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'images',
        'description',
        'website_url',
        'logo_image_url',
        'social_media_url',
        'status',
    ];
    protected $casts = [
        'satuts' => Status::class,
    ];

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
        $this->addMediaConversion('medium')
            ->performOnCollections('local_files')
            ->width(500)
            ->height(500)
            ->format('webp');
    }
}
