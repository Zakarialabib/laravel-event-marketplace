<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FAQSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        Faq::factory()->count(5)->create();
    }
}
