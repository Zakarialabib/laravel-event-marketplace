<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Shipping;

use App\Http\Livewire\WithSorting;
use App\Models\Shipping;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'delete',
    ];

    public int $perPage;

    public $shipping;

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

    public function confirmed(): void
    {
        $this->emit('delete');
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Shipping())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Shipping::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $shippings = $query->paginate($this->perPage);

        return view('livewire.admin.shipping.index', ['shippings' => $shippings])->extends('layouts.dashboard');
    }

    public function deleteModal($page): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->page = $page;
    }

    public function delete(): void
    {
        // abort_if(Gate::denies('shipping_delete'), 403);

        Shipping::findOrFail($this->page)->delete();

        $this->alert('success', __('Shipping deleted successfully.'));
    }
}
