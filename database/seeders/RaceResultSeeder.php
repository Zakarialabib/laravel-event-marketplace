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
                'race_id'      => '58946b4f-164a-4ed3-aafc-90f976271d4a',
                'participant_id'    => 'c728eccb-efe2-4185-9571-60734ffd2ed2',
                'registration_id'    => '0688b672-7c4d-4662-ba91-fbe3dc138b49',
                'place'        => 1,
                'time'         => '2:35:40',
                'date'         => '2023-10-10',
                'status'       => true,
            ],
        ]);
    }
}
