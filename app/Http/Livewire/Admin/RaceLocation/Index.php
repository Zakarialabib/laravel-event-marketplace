<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\RaceLocation;

use App\Http\Livewire\WithSorting;
use App\Models\RaceLocation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $raceLocation;

    public $name;

    public $listeners = [
        'refreshIndex' => '$refresh',
    ];

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
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

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new RaceLocation())->orderable;
    }

    public function render(): View|Factory
    {
        $query = RaceLocation::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $raceLocations = $query->paginate($this->perPage);

        return view('livewire.admin.race-location.index', compact('raceLocations'))->extends('layouts.dashboard');
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('raceLocation_delete'), 403);

        RaceLocation::whereIn('id', $this->selected)->delete();

        $this->alert('success', __('RaceLocation deleted successfully.'));

        $this->resetSelected();
    }

    public function delete(RaceLocation $raceLocation)
    {
        abort_if(Gate::denies('raceLocation_delete'), 403);

        if ($raceLocation->products()->isNotEmpty()) {
            $this->alert('error', __('Can\'t delete beacuse there are products associated with this raceLocation !'));
        }
        $raceLocation->delete();

        $this->alert('success', __('RaceLocation deleted successfully.'));
    }
}
