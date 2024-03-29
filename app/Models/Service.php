<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use App\Enums\Status;

class Service extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'price',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
