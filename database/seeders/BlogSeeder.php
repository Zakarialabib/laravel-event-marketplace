<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Blog::factory()
            ->count(10)
            ->create();
    }
}
