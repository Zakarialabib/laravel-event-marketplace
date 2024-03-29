<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Str;

enum OrderType: string
{
    case REGISTRATION = '0';

    case SERVICE = '1';

    case PRODUCT = '2';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public function getName(): string
    {
        return __(Str::studly($this->name));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function getLabel($value): ?string
    {
        foreach (self::cases() as $case) {
            if ($case->getValue() === $value) {
                return $case->getName();
            }
        }

        return null;
    }
}
