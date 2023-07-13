<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\Status;

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
        'description',
        'image',
        'slug',
        'status',
        'featured',
        'category_id',
        'meta_title',
        'meta_desc',
        'language_id',
    ];

      /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status'            => Status::class,
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
        return $query->where('status', Status::ACTIVE);
    }

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
        $this->addMediaCollection('local_files');
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('large')
            ->width(800)
            ->height(800)
            ->performOnCollections('local_files')
            ->format('webp');
    }
}
