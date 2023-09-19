<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\RaceResult;

use App\Exports\RaceResultsExport;
use App\Imports\RaceResultsImport;
use App\Models\RaceResult;
use App\Http\Livewire\WithSorting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $importModal;

    public $file;

    public $raceType;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortBy'        => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function getSelectedCountProperty(): int
    {
        return count($this->selected);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function updatedRaceType(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function downloadSelected()
    {
        return (new RaceResultsExport($this->selected))->download('race_results_exports.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function downloadAll()
    {
        return (new RaceResultsExport())->download('race_results_exports.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function importModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->importModal = true;
    }

    public function importResults(): void
    {
        // abort_if(Gate::denies('race_result_access'), 403);

        if ($this->file->extension() === 'xlsx' || $this->file->extension() === 'xls') {
            $filename = time().'-race-result.'.$this->file->getClientOriginalExtension();
            $this->file->storeAs('race-results', $filename);

            Excel::import(new RaceResultsImport(), $filename);

            $this->alert('success', __('Race Results imported successfully!'));
        } else {
            $this->alert('error', __('File is a '.$this->file->extension().' file.!! Please upload a valid xls/csv file..!!'));
        }

        $this->emit('refreshIndex');

        $this->importModal = false;
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new RaceResult())->orderable;
    }

    public function render(): View|Factory
    {
        $query = RaceResult::when($this->raceType, fn ($q) => $q->where('race_id', $this->raceType))
            ->advancedFilter([
                's'               => $this->search ?: null,
                'order_column'    => $this->sortBy,
                'order_direction' => $this->sortDirection,
            ]);

        $race_results = $query->paginate($this->perPage);

        return view('livewire.admin.race-result.index', ['race_results' => $race_results])
            ->extends('layouts.dashboard');
    }
}
