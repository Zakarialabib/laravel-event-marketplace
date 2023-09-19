<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use App\Enums\Status;

class ProductCategory extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
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
        'description',
        'slug',
        'type',
        'status',
    ];

    protected $casts = [
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
}
