<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'account access']);
        Permission::create(['name' => 'admin access']);
        Permission::create(['name' => 'client access']);

        $role1 = Role::create(['name' => 'admin']);

        $role2 = Role::create(['name' => 'vendor']);
        $role2->givePermissionTo('admin access');
        $role2->givePermissionTo('account access');

        // create roles and assign existing permissions
        $role3 = Role::create(['name' => 'client']);
        $role3->givePermissionTo('client access');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name'     => 'Vendor',
            'email'    => 'vendor@mail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name'     => 'Client',
            'email'    => 'client@mail.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role3);
    }
}
