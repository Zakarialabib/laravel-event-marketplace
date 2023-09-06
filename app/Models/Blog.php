<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasAdvancedFilter;
    use HasFactory;

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
        'meta_description',
        'language_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => Status::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
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
            ->width(800)
            ->height(800)
            ->format('webp');
    }
}
