<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use App\Support\HasAdvancedFilter;

class Language extends Model
{
    use HasAdvancedFilter;

    public const IS_DEFAULT = 1;

    public const IS_NOT_DEFAULT = 0;

    public const ATTRIBUTES = [
        'id',
        'name',
        'code',
        'status',
        'is_default',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'code',
        'status',
        'is_default',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
