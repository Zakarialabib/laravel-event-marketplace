<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Participant;
use App\Models\Race;
use App\Models\RaceResult;
use App\Models\Registration;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RaceRegistrationSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $participant = Participant::create([
            'email'                          => 'participant@example.com',
            'name'                           => 'John Doe',
            'gender'                         => 'Male',
            'birth_date'                     => '1990-01-01',
            'phone_number'                   => '1234567890',
            'country'                        => 'Country',
            'address'                        => 'Address',
            'city'                           => 'City',
            'zip_code'                       => '12345',
            'emergency_contact_name'         => 'Emergency Contact',
            'emergency_contact_phone_number' => '9876543210',
            'health_informations'            => 'Health Information',
            'status'                         => true,
            'user_id'                        => User::where('email', 'client@mail.com')->first()->id,
        ]);

        $registration = new Registration();
        $registration->fill([
            'registration_number' => Str::uuid(),
            'participant_id'      => $participant->id,
            'race_id'             => Race::where('name', 'Triathlon Dar Bouazza')->first()->id,
            'registration_date'   => now(),
            'status'              => true,
        ]);
        $registration->save();

        RaceResult::create([
            'race_id'         => Race::where('name', 'Triathlon Dar Bouazza')->first()->id,
            'participant_id'  => $participant->id,
            'registration_id' => $registration->id,
            'place'           => 1,
            'swimming'        => '00:15:30',
            'transition1'     => '00:02:00',
            'cycling'         => '01:30:45',
            'transition2'     => '00:01:30',
            'running'         => '00:45:15',
            'time'            => '03:35:00',
            'date'            => Carbon::now(),
            'status'          => true,
        ]);
    }
}
