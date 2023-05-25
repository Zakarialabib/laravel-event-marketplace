<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RaceLocation;
use Illuminate\Database\Seeder;

class RaceLocationSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        RaceLocation::factory()
            ->count(3)
            ->create();
    }
}
