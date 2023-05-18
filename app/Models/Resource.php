<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'images',
        'category_id',
    ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope to search resources by title
    public function scopeSearchByTitle($query, $searchTerm)
    {
        return $query->where('title', 'like', '%'.$searchTerm.'%');
    }
}
