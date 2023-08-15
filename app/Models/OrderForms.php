<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class OrderForms extends Model
{
    use HasAdvancedFilter;

    public $table = 'orderforms';

    public const ATTRIBUTES = [
        'id',
        'name',
        'email',
        'phone',
        'type',
        'status',
        'subject',
        'message',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
        'subject',
        'message',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
