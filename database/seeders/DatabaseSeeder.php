<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Seed the application's database. */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([

            LanguagesSeeder::class,
            SettingSeeder::class,
            // FeaturedBannerSeeder::class,
            BlogSeeder::class,
            SliderSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            PermissionRoleSeeder::class,
            SuperUserSeeder::class,
            RoleUserSeeder::class,
            
            CategorySeeder::class,
            ProductCategorySeeder::class,
            RaceLocationSeeder::class,
            RaceSeeder::class,
            
            PageSettingsSeeder::class,
        ]);
    }
}
