<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Str;

enum PaymentStatus: string
{
    // payment status paid cancled or whatever

    case PENDING = '0';

    case PAID = '1';

    case CANCELED = '2';

    case REFUNDED = '3';

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

    // loop through the values:

    // @foreach(App\Enums\PaymentStatus::values() as $key=>$value)
    //     <option value="{{ $key }}">{{ $value }}</option>
    // @endforeach
}
