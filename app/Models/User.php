<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Status;
use Spatie\Permission\Traits\HasRoles;
use App\Support\HasAdvancedFilter;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasAdvancedFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date',
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

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Race::class);
    }

    public function isAdmin()
    {
        return $this->roles->pluck('name')->contains(Role::ROLE_ADMIN);
    }

    public function isClient()
    {
        return $this->roles->pluck('name')->contains(Role::ROLE_CLIENT);
    }
}
