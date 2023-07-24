<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            [
                'id' => '1',
                'name' => 'Home',
                'type' => 'link',
                'label' => 'Home',
                'url' => 'home',
                'placement' => 'header',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'id' => '2',
                'name' => 'About',
                'type' => 'link',
                'label' => 'About',
                'url' => 'about',
                'placement' => 'header',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'id' => '3',
                'name' => 'Blog',
                'type' => 'link',
                'label' => 'Blog',
                'url' => 'resources',
                'placement' => 'header',
                'parent_id' => null,    
                'new_window' => false,
            ],
            [
                'id' => '4',
                'name' => 'Contact',
                'type' => 'link',
                'label' => 'Contact',
                'url' => 'contact',
                'placement' => 'header',
                'parent_id' => null,
                'new_window' => false,
            ]
        ]);
    }
}
