<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Status;
use App\Traits\HasUuid;

class Subscriber extends Model
{
    use HasAdvancedFilter;
    use HasUuid;
    use SoftDeletes;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'email',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'tag',
        'status',
        'email',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
