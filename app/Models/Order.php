<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ShippingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Enums\PaymentStatus;
use App\Traits\HasGlobalDate;
use App\Traits\HasUuid;
use App\Support\HasAdvancedFilter;

class Order extends Model
{
    use HasFactory;
    use HasGlobalDate;
    use HasUuid;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'user_id',
        'race_id',
        'service_id',
        'product_id',
        'amount',
        'payment_method',
        'status',
        'payment_status',
        'shipping_status',
        'shipping_id',
        'type',
        'date',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'id',
        'user_id',
        'race_id',
        'service_id',
        'product_id',
        'amount',
        'payment_method',
        'reference',
        'status',
        'payment_status',
        'shipping_status',
        'type',
        'date',
    ];

    protected $casts = [
        'status'          => OrderStatus::class,
        'payment_status'  => PaymentStatus::class,
        'shipping_status' => ShippingStatus::class,
        'type'            => OrderType::class,
    ];

    public static function generateReference()
    {
        $lastOrder = self::latest()->first();

        if ($lastOrder) {
            $number = substr($lastOrder->reference, -6) + 1;
        } else {
            $number = 1;
        }

        return date('Ymd').'-'.sprintf('%06d', $number);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function race()
    {
        return $this->belongsTo(Race::class, 'race_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
