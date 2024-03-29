<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(static function (Model $model): void {
            if (is_null($model->getOriginal('id'))) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
}
