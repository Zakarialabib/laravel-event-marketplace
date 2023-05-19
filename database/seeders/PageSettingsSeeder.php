<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageSettings;

class PageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageSettings::create([
            [
                'id'         => 1,
                'headerSettings' => json_encode([
                    'numberOfColumns' => 1,
                    'headerHeight'    => 100,
                    'logoUrl'         => null,
                    'logoSize'        => 50,
                    'logoPosition'    => 'left',
                    'hasSearchIcon'   => false,
                    'searchIcon'      => null,
                ]),
                'footerSettings' => json_encode([
                    'numberOfColumns' => 1,
                    'headerHeight'    => 100,
                    'logoUrl'         => null,
                    'logoSize'        => 50,
                    'logoPosition'    => 'left',
                    'hasNewslettersForm'      => false,
                ]),
                'themeColor' => json_encode([
                    'primary' => 'blue-600',
                    'secondary' => 'gray-200',
                    'danger' => 'red-600',
                    'warning' => 'orange-600',
                    'info' => 'blue-200',
                    'success' => 'green-600',
                    'dark' => 'black'
                ]),
                'menuItems' => json_encode([
                    'menuName' => 'Main Menu',
                    'items'    => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'About', 'url' => '/about'],
                        ['label' => 'Contact', 'url' => '/contact'],
                    ],
                ]),
                'popularProducts' => false,
                'flashDeal' => false,
                'bestSellers' => false,
                'topBrands' => false,
                'status' => true,
                'is_default' => true,
                'page_id' => null, // adjust based on your relationships
                'language_id' => null, // adjust based on your relationships
            ],
        ]);
    }

}
