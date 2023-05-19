<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class RaceRegistration extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'name',
        'category_id',
        'registration_id',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'description',
        'images',
        'options',
        'registration_id',
        'category_id',
    ];

    public function scopeWithCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
