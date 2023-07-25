<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasAdvancedFilter;

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            if (is_null($model->getOriginal('id'))) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
}
