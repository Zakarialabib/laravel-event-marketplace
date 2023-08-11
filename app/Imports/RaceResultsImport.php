<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\RaceResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // use this if your excel sheet has headings

class RaceResultsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Extract values from the row
        $raceId = $row['race_id'];
        $participantId = $row['participant_id'];
        $time = $row['time'];
        $place = $row['place'];
        $date = $row['date'];

        // Try to find an existing result based on race_id and participant_id
        $raceResult = RaceResult::where('race_id', $raceId)
            ->where('participant_id', $participantId)
            ->first();

        if ($raceResult) {
            // Update if found
            $raceResult->update([
                'time'  => $time,
                'place' => $place,
                'date'  => $date,
                // ... add other fields as needed
            ]);
        } else {
            // Create if not found
            RaceResult::create([
                'race_id'        => $raceId,
                'participant_id' => $participantId,
                'time'           => $time,
                'place'          => $place,
                'date'           => $date,
                // ... add other fields as needed
            ]);
        }

        return null; // As we're directly handling the update/create process
    }
}
