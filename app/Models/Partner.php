<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends Model implements HasMedia
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
        'description',
        'website_url',
        'logo_image_url',
        'images',
        'social_media_urls',
        'status',
    ];

    protected $casts = [
        'images'            => 'json',
        'social_media_urls' => 'json',
        // 'status' => Status::class,
    ];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('partners')->withResponsiveomage();
    }
  
    public function registerMediaConversions(): void
    {
        $this->addMediaConversion('thumb')
            ->width(1000)
            ->height(1000)
            ->performOnCollections('partners')
            ->format('webp');
    }
}

