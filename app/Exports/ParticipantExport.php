<?php
declare(strict_types=1);

namespace App\Exports;

use App\Models\Participant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ParticipantExport implements FromView
{
    use Exportable;

    /** @var array|null */
    protected $ids;

    public function __construct(
        ?array $ids = null
    ) {
        $this->ids = $ids;
    }

    public function query()
    {
        if ($this->ids) {
            return Participant::query()->whereIn('id', $this->ids);
        }

        return Participant::query()->with('user', 'orders');
    }

    public function view(): View
    {
        return view('pdf.participants', [
            'data' => $this->query()->get(),
        ]);
    }
}
