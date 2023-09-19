<?php

declare(strict_types=1);

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    final public const ROLE_ADMIN = 'admin';

    final public const ROLE_CLIENT = 'client';
}
