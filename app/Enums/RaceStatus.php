<?php

declare(strict_types=1);

namespace App\Enums;
use Illuminate\Support\Str;

enum RaceStatus: int
{
    case SCHEDULE = 0;

    case ONGOING = 1;

    case ENDED = 3;

    case COMING = 4;

    case CANCELED = 5;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public function getName()
    {
        return __(Str::studly($this->name));
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public static function getLabel($value)
    {
        foreach (self::cases() as $case) {
            if ($case->getValue() === $value) {
                return $case->getName();
            }
        }

        return null;
    }
}
