<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'website_url',
        'logo_image_url',
        'images',
        'social_media_urls',
        'status',
    ];

    protected $casts = [
        'images'            => 'json',
        'social_media_urls' => 'json',
        // 'status' => Status::class,
    ];
}
