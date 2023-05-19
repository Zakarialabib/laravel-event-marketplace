<?php

declare(strict_types=1);

namespace App\Enums;

enum RaceStatus: string
{
    case SCHEDULE = '0';

    case ONGOING = '1';
    
    case ENDED = '3';
    
    case COMING = '4';
    
    case CANCELED = '5';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
