<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Str;

enum OrderStatus: string
{
    case PENDING = '0';

    case PROCESSING = '1';

    case COMPLETED = '2';

    case SHIPPED = '3';

    case RETURNED = '4';

    case CANCELED = '5';

    case FAILED = '6';

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
