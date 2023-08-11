<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use App\Traits\ForModels;

class RegistrationExport implements FromView
{
    use Exportable;
    use ForModels;

    /** @var mixed */
    protected $models;

    public function __construct(
        $models = null
    ) {
        $this->models = $models;
    }

    public function query()
    {
        if ($this->models) {
            return Registration::query()->whereIn('id', $this->models);
        }

        return Registration::query()->with('participant', 'service', 'orders');
    }

    public function view(): View
    {
        return view('pdf.registrations', [
            'data' => $this->query()->get(),
        ]);
    }
}
