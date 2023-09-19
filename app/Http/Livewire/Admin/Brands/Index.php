<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

use App\Http\Livewire\WithSorting;
use App\Imports\BrandsImport;
use App\Models\Brand;
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

    public $brand;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'importModal',
        'delete',
    ];

    public $deleteModal = false;

    public $showModal = false;

    public $importModal = false;

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

    public function confirmed(): void
    {
        $this->emit('delete');
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Brand())->orderable;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('brand_access'), 403);

        $query = Brand::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $brands = $query->paginate($this->perPage);

        return view('livewire.admin.brands.index', ['brands' => $brands])->extends('layouts.dashboard');
    }

    public function showModal(Brand $brand): void
    {
        abort_if(Gate::denies('brand_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->brand = $brand;

        $this->showModal = true;
    }

    public function deleteModal($brand): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->brand = $brand;
    }

    public function delete(): void
    {
        abort_if(Gate::denies('brand_delete'), 403);

        Brand::findOrFail($this->brand)->delete();

        $this->alert('success', __('Brand deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('brand_delete'), 403);

        // Delete the brands
        Brand::whereIn('id', $this->selected)->delete();

        $this->resetSelected();

        $this->alert('success', __('Selected brands deleted successfully.'));
    }

    public function importModal(): void
    {
        // abort_if(Gate::denies('brand_create'), 403);

        $this->importModal = true;
    }

    // public function import(): void
    // {
    //     // abort_if(Gate::denies('brand_create'), 403);

    //     $this->validate([
    //         'file' => 'required|mimes:xlsx',
    //     ]);

    //     Excel::import(new BrandsImport(), $this->file);

    //     $this->alert('success', __('Brand imported successfully.'));
    // }
}
