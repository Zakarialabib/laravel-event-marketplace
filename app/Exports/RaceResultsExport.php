<?php

declare(strict_types=1);

namespace App\Exports;

use App\Enums\Status;
use App\Models\RaceResult;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Traits\ForModels;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class RaceResultsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, ShouldQueue
{
    use Exportable;
    use ForModels;

    /** @var mixed */
    protected $models;

    public function __construct($models = null)
    {
        $this->models = $models;
    }

    public function query()
    {
        if ($this->models) {
            return RaceResult::query()->whereIn('id', $this->models)->with('participant', 'race', 'registration');
        }

        return RaceResult::query()->with('participant', 'race', 'registration');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Race Name',
            'Race ID',
            'Participant Name',
            'Participant ID',
            'Registration ID',
            'Place',
            'Swimming',
            'Transition1',
            'Cycling',
            'Transition2',
            'Running',
            'Time',
            'Date',
            'Status',
        ];
    }

    /**
     * @param RaceResult $raceResult
     * @return array
     */
    public function map($raceResult): array
    {
        return [
            $raceResult->id,
            $raceResult->race->name,
            $raceResult->race->id,
            $raceResult->participant->name,
            $raceResult->participant->id,
            $raceResult->registration->id,
            $raceResult->place,
            $raceResult->swimming,
            $raceResult->transition1,
            $raceResult->cycling,
            $raceResult->transition2,
            $raceResult->running,
            $raceResult->time,
            $raceResult->date,
            Status::getLabel($raceResult->status),
        ];
    }
}
