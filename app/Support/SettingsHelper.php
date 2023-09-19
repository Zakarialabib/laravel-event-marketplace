<?php

declare(strict_types=1);

if ( ! function_exists('settings')) {
    function settings(string $key)
    {
        return cache()->rememberForever('settings', function () {
            return \App\Models\Settings::pluck('value', 'key');
        })->get($key);
    }
}

if ( ! function_exists('formatCurrency')) {
    function formatCurrency($value, bool $format = true)
    {
        if ( ! $format) {
            return $value;
        }

        $currency = \App\Models\Currency::where('is_default', 1)->first();
        $position = $currency->position;
        $symbol = $currency->symbol;

        return $position === 'prefix'
            ? $symbol.number_format((float) $value, 0, '.', ',')
            : number_format((float) $value, 0, '.', ',').' '.$symbol;
    }
}

if ( ! function_exists('formatDate')) {
    function formatDate($value): ?string
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        if (empty($value) || ! is_string($value) || strlen($value) < 10) {
            return null;
        }

        $dateString = substr($value, 0, 10);

        try {
            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $dateString);
        } catch (\Exception $e) {
            return null;
        }

        return $date->format('Y-m-d');
    }
}
