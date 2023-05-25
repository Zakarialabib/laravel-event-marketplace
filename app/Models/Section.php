<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasAdvancedFilter;

    public const HOME_PAGE = 1;

    public const ABOUT_PAGE = 2;

    public const BRAND_PAGE = 3;

    public const BLOG_PAGE = 4;

    public const CATALOG_PAGE = 5;

    public const BRANDS_PAGE = 6;

    public const CONTACT_PAGE = 7;

    public const PRODUCT_PAGE = 8;

    public const PRIVACY_PAGE = 9;

    public $table = 'sections';

    public $orderable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    public $filterable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    protected $fillable = [
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('sliders');
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('large')
            ->width(1000)
            ->height(400)
            ->performOnCollections('sliders')
            ->withResponsiveImages()
            ->format('webp');
    }
}
