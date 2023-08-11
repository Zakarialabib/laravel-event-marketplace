<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Service::insert([
            [
                'id'          => 1,
                'title'       => 'Photo shooting',
                'description' => 'Service Details',
                'price'       => 200,
                'status'      => 1,
            ],
            [
                'id'          => 2,
                'title'       => 'Service title',
                'description' => 'Service Details',
                'price'       => 500,
                'status'      => 1,
            ],
            [
                'id'          => 3,
                'title'       => 'Service title',
                'description' => 'Service Details',
                'price'       => 100,
                'status'      => 1,
            ],
        ]);
    }
}
