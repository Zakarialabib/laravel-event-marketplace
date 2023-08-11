<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\RaceResult;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Traits\ForModels;

class RaceResultsExport implements FromQuery, WithHeadings
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
            'Race ID',
            'Participant ID',
            'Registration ID',
            'Place',
            'Time',
            'Date',
            'Status',
        ];
    }
}
