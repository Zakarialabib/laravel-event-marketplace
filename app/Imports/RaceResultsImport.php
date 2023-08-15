<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\RaceResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RaceResultsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $raceId = $row['race_id'];
        $participantId = $row['participant_id'];
        $time = $row['time'];
        $place = $row['place'];
        $date = $row['date'];
        $swimming = $row['swimming'] ?? null;
        $transition1 = $row['transition1'] ?? null;
        $cycling = $row['cycling'] ?? null;
        $transition2 = $row['transition2'] ?? null;
        $running = $row['running'] ?? null;

        $raceResult = RaceResult::where('race_id', $raceId)
            ->where('participant_id', $participantId)
            ->first();

        if ($raceResult) {
            $raceResult->update([
                'time'        => $time,
                'place'       => $place,
                'date'        => $date,
                'swimming'    => $swimming,
                'transition1' => $transition1,
                'cycling'     => $cycling,
                'transition2' => $transition2,
                'running'     => $running,
            ]);
        } else {
            RaceResult::create([
                'race_id'        => $raceId,
                'participant_id' => $participantId,
                'time'           => $time,
                'place'          => $place,
                'date'           => $date,
                'swimming'       => $swimming,
                'transition1'    => $transition1,
                'cycling'        => $cycling,
                'transition2'    => $transition2,
                'running'        => $running,
                'status'         => true,
            ]);
        }

        return null;
    }
}
