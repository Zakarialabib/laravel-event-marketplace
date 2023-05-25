<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::insert([
            [
                'id'          => 1,
                'name'        => 'Textile',
                'description' => 'textile',
                'slug'        => 'textile',
                'type'        => 'product',
                'status'      => true,
            ],
            [
                'id'          => 2,
                'name'        => 'Eyewar',
                'description' => 'Eyewar',
                'slug'        => 'Eyewar',
                'type'        => 'product',
                'status'      => true,
            ],
            [
                'id'          => 3,
                'name'        => 'Accessories',
                'description' => 'accessories',
                'slug'        => 'accessories',
                'type'        => 'product',
                'status'      => true,
            ],
            [
                'id'          => 4,
                'name'        => 'Nutririon',
                'description' => 'nutririon',
                'slug'        => 'nutririon',
                'type'        => 'product',
                'status'      => true,
            ],
        ]);
    }
}
