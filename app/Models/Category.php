<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use App\Enums\Status;
use Str;

class Category extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'name',
        'slug',
        'type',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'images',
        'description',
        'slug',
        'type',
        'status',
    ];

    protected $casts = [
        'images' => 'json',
        'status' => Status::class,
    ];

    // Scope for active categories
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for categories of a specific type
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

      // Accessor for formatted category name
    public function getFormattedNameAttribute()
    {
        return ucfirst($this->name);
    }

    // Mutator for category slug
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
