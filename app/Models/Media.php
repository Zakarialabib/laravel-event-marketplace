<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use App\Enums\Status;

class Media extends Model
{
    use HasAdvancedFilter;

    protected $fillable = [
        'race_id',
        'type',
        'src',
        'url',
        'description',
        'status',
    ];

    public const ATTRIBUTES = [
        'id',
        'race_id',
        'type',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $casts = [
        'status' => Status::class,
    ];

    // Define the relationship with the Race model
    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
