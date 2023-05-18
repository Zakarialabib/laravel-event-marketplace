<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'images',
        'options',
        'category_id',
    ];

    // Scope for locations with a specific category
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
