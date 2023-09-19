<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Http\Livewire\WithSorting;
use App\Jobs\PublishResults;
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

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function selectAll(): void
    {
        if (count(array_intersect($this->selected, Race::pluck('id')->toArray())) === count(Race::pluck('id')->toArray())) {
            $this->selected = [];
        } else {
            $this->selected = Race::pluck('id')->toArray();
        }
    }

    public function publishResults($id): void
    {
        PublishResults::dispatch($id);
        $this->alert('success', __('Race results are being generated.'));
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Race())->orderable;
    }

    public function delete(Race $race): void
    {
        // abort_if(Gate::denies('race_delete'), 403);

        $race->delete();

        $this->alert('success', __('Race deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        // abort_if(Gate::denies('race_delete'), 403);

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

        return view('livewire.admin.race.index', ['races' => $races])->extends('layouts.dashboard');
    }
}
