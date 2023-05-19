<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'title',
        'slug',
        'status',
        'featured',
        'category_id',
        'language_id',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title',
        'details',
        'image',
        'slug',
        'status',
        'featured',
        'category_id',
        'meta_title',
        'meta_desc',
        'language_id',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blogs')->withResponsiveomage();
    }
  
    public function registerMediaConversions(): void
    {
        $this->addMediaConversion('thumb')
            ->width(1000)
            ->height(1000)
            ->performOnCollections('blogs')
            ->format('webp');
    }
}

