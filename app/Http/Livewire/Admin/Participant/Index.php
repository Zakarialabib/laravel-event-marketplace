<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Participant;

use App\Exports\ParticipantExport;
use App\Models\Participant;
use App\Http\Livewire\WithSorting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;
    public array $orderable;
    public string $search = '';
    public array $selected = [];
    public array $paginationOptions;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortBy'        => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function downloadSelected()
    {
        return (new ParticipantExport($this->selected))->download('registrations.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function downloadAll()
    {
        return (new ParticipantExport())->download('registrations.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Participant())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Participant::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $participants = $query->paginate($this->perPage);

        return view('livewire.admin.participant.index', compact('participants'))
            ->extends('layouts.dashboard');
    }
}
