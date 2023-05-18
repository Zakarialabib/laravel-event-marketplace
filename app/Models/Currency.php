<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id', 'name', 'sign', 'value',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name', 'sign', 'value',
    ];
}
