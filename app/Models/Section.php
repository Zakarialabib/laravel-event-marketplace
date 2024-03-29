<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PageType;
use App\Enums\Status;

class Section extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasAdvancedFilter;

    public $table = 'sections';

    final public const ATTRIBUTES = [
        'id',
        'status',
        'title',
        'position',
        'page',
        'language_id',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

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

    protected $casts = [
        'page'   => PageType::class,
        'satuts' => Status::class,
    ];

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     */
    public function scopeActive($query): void
    {
        $query->where('status', 1);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('local_files');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->performOnCollections('local_files')
            ->width(720)
            ->height(480)
            ->format('webp');
    }
}
