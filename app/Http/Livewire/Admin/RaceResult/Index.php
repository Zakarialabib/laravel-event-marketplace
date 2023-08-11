<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\RaceResult;

use App\Exports\RaceResultsExport;
use App\Models\RaceResult;
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
    public $activeTab;
    public $racer_result;

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
        return (new RaceResultsExport($this->selected))->download('race_results.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function downloadAll()
    {
        return (new RaceResultsExport())->download('race_results.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new RaceResult())->orderable;
        $this->activeTab ??= 'all';
    }

    public function render(): View|Factory
    {
        $query = RaceResult::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $race_results = $query->paginate($this->perPage);

        return view('livewire.admin.race-result.index', compact('race_results'))
            ->extends('layouts.dashboard');
    }
}
