<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasGlobalDate
{
    public function getDateAttribute($value)
    {
        $date = $value instanceof \DateTimeInterface ? $value : new Carbon($value);
        return $date->format('Y-m-d');
    }


    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $value);
    }
}