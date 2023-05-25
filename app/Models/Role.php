<?php

declare(strict_types=1);

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public const ROLE_ADMIN = 'admin';

    public const ROLE_VENDOR = 'vendor';

    public const ROLE_CLIENT = 'client';
}
