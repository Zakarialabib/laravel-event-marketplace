<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceRegistration extends Model
{
    use HasFactory;

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
