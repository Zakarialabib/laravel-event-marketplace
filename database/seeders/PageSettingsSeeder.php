<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pagesetting;

class PagesettingsSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        Pagesetting::create([
            'id'             => 1,
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
                'numberOfColumns'    => 1,
                'headerHeight'       => 100,
                'logoUrl'            => null,
                'logoSize'           => 50,
                'logoPosition'       => 'left',
                'hasNewslettersForm' => false,
            ]),
            'themeColor' => json_encode([
                'primary'   => 'blue-600',
                'secondary' => 'gray-200',
                'danger'    => 'red-600',
                'warning'   => 'orange-600',
                'info'      => 'blue-200',
                'success'   => 'green-600',
                'dark'      => 'black',
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
            'flashDeal'       => false,
            'bestSellers'     => false,
            'topBrands'       => false,
            'status'          => true,
            'is_default'      => true,
            'page_id'         => null,
            'language_id'     => null,
        ]);
    }
}
