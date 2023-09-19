<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\ProductCategory;

use App\Http\Livewire\WithSorting;
use App\Models\ProductCategory;
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

    public $category;

    public $file;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'importModal',
    ];

    public int $perPage;

    public $importModal;

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
        $this->orderable = (new ProductCategory())->orderable;
    }

    public function render(): View|Factory
    {
        $query = ProductCategory::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $categories = $query->paginate($this->perPage);

        return view('livewire.admin.product-category.index', ['categories' => $categories])->extends('layouts.dashboard');
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('category_delete'), 403);

        ProductCategory::whereIn('id', $this->selected)->delete();

        $this->alert('success', __('ProductCategory deleted successfully.'));

        $this->resetSelected();
    }

    public function delete(ProductCategory $category): void
    {
        abort_if(Gate::denies('category_delete'), 403);

        $category->delete();

        $this->alert('success', __('ProductCategory deleted successfully.'));
    }
}
