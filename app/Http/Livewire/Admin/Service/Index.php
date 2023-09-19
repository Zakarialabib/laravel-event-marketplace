<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Service;

use App\Http\Livewire\WithSorting;
use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $service;

    public $file;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'importModal',
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

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Service())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Service::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $services = $query->paginate($this->perPage);

        return view('livewire.admin.service.index', ['services' => $services])->extends('layouts.dashboard');
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('service_delete'), 403);

        Service::whereIn('id', $this->selected)->delete();

        $this->alert('success', __('Service deleted successfully.'));

        $this->resetSelected();
    }

    public function delete(Service $service): void
    {
        abort_if(Gate::denies('service_delete'), 403);

        $service->delete();

        $this->alert('success', __('Service deleted successfully.'));
    }
}
