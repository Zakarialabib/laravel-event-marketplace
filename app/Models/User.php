<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Status;
use App\Enums\RoleType;
use Spatie\Permission\Traits\HasRoles;
use App\Support\HasAdvancedFilter;
use App\Traits\HasUuid;

class User extends Authenticatable
{
    use HasUuid;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'status'            => Status::class,
    ];

    public function races()
    {
        return $this->hasMany(Race::class);
    }

    public function participations()
    {
        return $this->hasManyThrough(Race::class, Registration::class, 'participant_id', 'id', 'id', 'race_id');
    }

    public function isAdmin()
    {
        return $this->roles->pluck('name')->contains(RoleType::ADMIN);
    }

    public function isClient()
    {
        return $this->roles->pluck('name')->contains(RoleType::CLIENT);
    }
}
