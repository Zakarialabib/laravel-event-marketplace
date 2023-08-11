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

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;
    public array $orderable;
    public string $search = '';
    public array $selected = [];
    public array $paginationOptions;
    public $importModal;
    public $file;

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

    public function importModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->importModal = true;
    }

    public function importResults()
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

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new RaceResult())->orderable;
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
