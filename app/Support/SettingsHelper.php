<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use App\Models\Currency;
use App\Models\Settings;
use Carbon\Carbon;
use DateTimeInterface;
use Exception;

class SettingsHelper
{
    /**
     * Fetch Cached settings from the database.
     *
     * @return mixed
     */
    public static function settings(string $key)
    {
        return Cache::rememberForever('settings', function () {
            return Settings::pluck('value', 'key');
        })->get($key);
    }

    /**
     * Format a currency value based on the default currency settings.
     *
     * @param mixed $value
     * @param bool $format
     *
     * @return mixed
     */
    public static function formatCurrency($value, bool $format = true)
    {
        if ( ! $format) {
            return $value;
        }

        $currency = Currency::where('is_default', 1)->first();
        $position = $currency->position;
        $symbol = $currency->symbol;

        return $position === 'prefix'
            ? $symbol.number_format((float) $value, 0, '.', ',')
            : number_format((float) $value, 0, '.', ',').' '.$symbol;
    }

    /**
     * Format a date value in 'Y-m-d' format.
     *
     * @param mixed $value
     *
     * @return string|null
     */
    public static function formatDate($value): ?string
    {
        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        if (empty($value) || ! is_string($value) || strlen($value) < 10) {
            return null;
        }

        $dateString = substr($value, 0, 10);

        try {
            $date = Carbon::createFromFormat('Y-m-d', $dateString);
        } catch (Exception $e) {
            return null;
        }

        return $date->format('Y-m-d');
    }
}
