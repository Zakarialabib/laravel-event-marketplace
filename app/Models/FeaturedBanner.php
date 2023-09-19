<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class FeaturedBanner extends Model
{
    use HasAdvancedFilter;

    final public const StatusInactive = 0;

    final public const StatusActive = 1;

    final public const ATTRIBUTES = [
        'id', 'title', 'status', 'featured', 'language_id',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title', 'details', 'image', 'embeded_video', 'status', 'featured',
        'link', 'language_id', 'product_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
