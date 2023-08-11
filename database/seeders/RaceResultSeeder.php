<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RaceResult;
use Illuminate\Database\Seeder;

class RaceResultSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        RaceResult::insert([
            [
                'id'           => 1,
                'race_id'      => 1,
                'participant_id'    => 1,
                'place'        => 1,
                'time'         => '2:35:40',
                'date'         => '2023-10-10',
                'status'       => true,
            ],
            [
                'id'           => 2,
                'race_id'      => 2,
                'participant_id'    => 2,
                'place'        => 2,
                'time'         => '2:35:45',
                'date'         => '2023-10-10',
                'status'       => true,
            ],
        ]);
    }
}
