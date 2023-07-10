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
            CurrenciesSeeder::class,
            BlogSeeder::class,
            SliderSeeder::class,
            PermissionsDemoSeeder::class,
            PermissionsSeeder::class,
            SponsorSeeder::class,
            CategorySeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            RaceLocationSeeder::class,
            RaceSeeder::class,
            FaqSeeder::class,

            // PagesettingsSeeder::class,
        ]);

        \App\Models\Race::factory(10)->create();
    }
}
