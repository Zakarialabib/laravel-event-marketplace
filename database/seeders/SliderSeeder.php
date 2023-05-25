<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Slider::factory()
            ->count(5)
            ->create();
    }
}
