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
                'images'       => 'https://via.placeholder.com/500x500.png?text=textile',
                'status'      => true,
            ],
            [
                'id'          => 2,
                'name'        => 'Eyewar',
                'description' => 'Eyewar',
                'slug'        => 'Eyewar',
                'type'        => 'product',
                'images'       => 'https://via.placeholder.com/500x500.png?text=Eyewar',
                'status'      => true,
            ],
            [
                'id'          => 3,
                'name'        => 'Accessories',
                'description' => 'accessories',
                'slug'        => 'accessories',
                'type'        => 'product',
                'images'       => 'https://via.placeholder.com/500x500.png?text=accessories',
                'status'      => true,
            ],
            [
                'id'          => 4,
                'name'        => 'Nutririon',
                'description' => 'nutririon',
                'slug'        => 'nutririon',
                'type'        => 'product',
                'images'       => 'https://via.placeholder.com/500x500.png?text=nutririon',
                'status'      => true,
            ],
        ]);
    }
}
