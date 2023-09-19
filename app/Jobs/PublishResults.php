<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\RaceResult;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishResults implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected $raceId)
    {
    }

    public function handle(): void
    {
        $registrations = Registration::where('race_id', $this->raceId)->get();

        foreach ($registrations as $registration) {
            RaceResult::create([
                'race_id'         => $this->raceId,
                'participant_id'  => $registration->participant_id,
                'registration_id' => $registration->id,
                // 'place' and 'time' would be added by the admin later on.
            ]);
        }
    }
}
