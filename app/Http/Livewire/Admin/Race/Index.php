<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Http\Livewire\WithSorting;
use App\Models\Race;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $race;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'delete',
    ];

    public int $perPage;

    public array $orderable;

    public $selectAll;

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

    public function selectAll()
    {
        if (count(array_intersect($this->selected, Race::pluck('id')->toArray())) === count(Race::pluck('id')->toArray())) {
            $this->selected = [];
        } else {
            $this->selected = Race::pluck('id')->toArray();
        }
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Race())->orderable;
    }

    public function delete(Race $race)
    {
        abort_if(Gate::denies('race_delete'), 403);

        $race->delete();

        $this->alert('success', __('Race deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('race_delete'), 403);

        Race::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function render(): View|Factory
    {
        $query = Race::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $races = $query->paginate($this->perPage);

        return view('livewire.admin.race.index', compact('races'))->extends('layouts.dashboard');
    }
}
