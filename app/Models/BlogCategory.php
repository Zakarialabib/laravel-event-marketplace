<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class BlogCategory extends Model
{
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'title',
        'language_id',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title',
        'description',
        'meta_tag',
        'meta_description',
        'language_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = str_replace(' ', '-', (string) $value);
    }
}
