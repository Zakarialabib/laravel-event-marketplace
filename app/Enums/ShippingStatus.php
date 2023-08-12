<?php

declare(strict_types=1);

namespace App\Enums;
use Illuminate\Support\Str;

enum ShippingStatus: string
{
    case  PENDING = '0';
    case  PREPARING = '1';
    case SUBMITTED = '2';
    case  SHIPPING = '3';
    case  DELIVERED = '4';
    case  CANCELLED = '5';
    case  FAILED = '6';

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
