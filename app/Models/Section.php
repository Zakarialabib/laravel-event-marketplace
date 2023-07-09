<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
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

    public const ATTRIBUTES = [
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
        'page' => PageType::class,
        'satuts' => Status::class,
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
        $this->addMediaCollection('local_files');
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('large')
            ->width(1000)
            ->height(400)
            ->performOnCollections('local_files')
            ->format('webp');
    }
}
