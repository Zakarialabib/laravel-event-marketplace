<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id'       => 999,
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('password'),
            // 'city'           => 'Casablanca',
            // 'country'        => 'Morocco',
            // 'address'        => 'Casablanca',
            // 'phone'          => '123456789',
            // 'status'         => 1,
            'remember_token' => null,
            'created_at'     => now(),
        ]);
    }
}
