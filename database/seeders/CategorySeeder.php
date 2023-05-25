<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'id'          => 1,
                'name'        => 'Runing',
                'description' => 'running',
                'slug'        => 'running',
                'type'        => 'race',
                'status'      => true,
            ],
            [
                'id'          => 2,
                'name'        => 'trail running',
                'description' => 'trail running',
                'slug'        => 'trail-running',
                'type'        => 'race',
                'status'      => true,
            ],
            [
                'id'          => 3,
                'name'        => 'Triathlon',
                'description' => 'triathlon',
                'slug'        => 'triathlon',
                'type'        => 'race',
                'status'      => true,
            ],
        ]);
    }
}
