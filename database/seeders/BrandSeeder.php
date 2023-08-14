<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            [
                'id'               => 1,
                'name'             => 'North Face',
                'slug'             => Str::slug('North Face'),
                'description'      => 'The North Face is an American outdoor recreation products company. The North Face produces clothing, footwear, and outdoor equipment. The company is headquartered in Alameda, California, co-located with its corporate sibling, JanSport.',
                'image'            => 'north-face.png',
                'meta_title'       => Str::limit('North Face', 60),
                'meta_description' => Str::limit('The North Face is an American outdoor recreation products company. The North Face produces clothing, footwear, and outdoor equipment. The company is headquartered in Alameda, California, co-located with its corporate sibling, JanSport.', 160),
            ],
            [
                'id'               => 2,
                'name'             => 'Adidas',
                'slug'             => Str::slug('Adidas'),
                'description'      => 'Adidas AG is a German multinational corporation, founded and headquartered in Herzogenaurach, Germany, that designs and manufactures shoes, clothing and accessories. It is the largest sportswear manufacturer in Europe, and the second largest in the world, after Nike.',
                'image'            => 'adidas.png',
                'meta_title'       => Str::limit('Adidas', 60),
                'meta_description' => Str::limit('Adidas AG is a German multinational corporation, founded and headquartered in Herzogenaurach, Germany, that designs and manufactures shoes, clothing and accessories. It is the largest sportswear manufacturer in Europe, and the second largest in the world, after Nike.', 160),
            ],
            [
                'id'               => 3,
                'name'             => 'Nike',
                'slug'             => Str::slug('Nike'),
                'description'      => 'Nike, Inc. is an American multinational corporation that is engaged in the design, development, manufacturing, and worldwide marketing and sales of footwear, apparel, equipment, accessories, and services.',
                'image'            => 'nike.png',
                'meta_title'       => Str::limit('Nike', 60),
                'meta_description' => Str::limit('Nike, Inc. is an American multinational corporation that is engaged in the design, development, manufacturing, and worldwide marketing and sales of footwear, apparel, equipment, accessories, and services.', 160),
            ],
        ]);
    }
}
