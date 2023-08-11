<?php

namespace App\Jobs;

use App\Models\RaceResult;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishResults implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $raceId;

    public function __construct($raceId)
    {
        $this->raceId = $raceId;
    }

    public function handle()
    {
        $registrations = Registration::where('race_id', $this->raceId)->get();

        foreach ($registrations as $registration) {
            RaceResult::create([
                'race_id' => $this->raceId,
                'participant_id' => $registration->participant_id,
                'registration_id' => $registration->id,
                // 'place' and 'time' would be added by the admin later on.
            ]);
        }
    }
}
