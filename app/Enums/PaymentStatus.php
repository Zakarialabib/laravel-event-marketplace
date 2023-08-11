<?php

declare(strict_types=1);

namespace App\Enums;

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

    // loop through the values:

    // @foreach(App\Enums\PaymentStatus::values() as $key=>$value)
    //     <option value="{{ $key }}">{{ $value }}</option>
    // @endforeach
}
