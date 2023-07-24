<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderForms
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property string|null $address
 * @property string $type
 * @property bool $status
 * @property string|null $subject
 * @property string|null $message
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderForms whereUserId($value)
 *
 * @mixin \Eloquent
 */
class OrderForms extends Model
{
    use HasAdvancedFilter;

    public const HOME_FORM = 1;

    public const PRODUCT_FORM = 2;
    
    public const SUBSCRIBE_FORM = 2;

    public $table = 'orderforms';

    public $orderable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
        'subject',
        'message',
    ];

    public $filterable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
        'subject',
        'message',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
        'subject',
        'message',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
