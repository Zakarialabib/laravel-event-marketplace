<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Subscriber extends Model
{
    use HasAdvancedFilter;


    public const ATTRIBUTES = [
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
        'email'
    ];

    protected $casts = [
        'status'            => Status::class,
    ];

}
