<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    public const  PENDING = '0';
    public const  PREPARING = '1';
    public const SUBMITTED = '2';
    public const  SHIPPING = '3';
    public const  DELIVERED = '4';
    public const  CANCELLED = '5';
    public const  FAILED = '6';
}
