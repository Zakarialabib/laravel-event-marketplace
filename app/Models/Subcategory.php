<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id', 'category_id', 'name', 'slug',

    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'category_id', 'name', 'slug',
    ];

    public function scopeActive($query): void
    {
        $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }
}
