<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account;

use App\Models\RaceResult;
use Livewire\Component;
use App\Http\Livewire\WithSorting;
use Livewire\WithPagination;

class RaceResults extends Component
{
    use WithSorting;
    use WithPagination;

    public $participant;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortBy'        => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function mount($participant): void
    {
        $this->participant = $participant;
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new RaceResult())->orderable;
    }

    public function render()
    {
        $query = RaceResult::where('participant_id', $this->participant->id)
            ->with('race')
            ->advancedFilter([
                's'               => $this->search ?: null,
                'order_column'    => $this->sortBy,
                'order_direction' => $this->sortDirection,
            ]);

        $results = $query->paginate($this->perPage);

        return view('livewire.account.race-results', ['results' => $results]);
    }
}
