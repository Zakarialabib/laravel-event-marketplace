<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Http\Livewire\WithSorting;
use App\Models\BlogCategory;
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

    public $listeners = [
        'refreshIndex' => '$refresh',
        'delete',
    ];

    public $blogcategory;

    public $deleteModal = false;

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
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new BlogCategory())->orderable;
    }

    public function deleteModal($blogcategory): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->blogcategory = $blogcategory;
    }

    public function delete(): void
    {
        abort_if(Gate::denies('blogcategory_delete'), 403);

        BlogCategory::findOrFail($this->blogcategory)->delete();

        $this->alert('success', __('BlogCategory deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('blogcategory_delete'), 403);

        BlogCategory::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function render(): View|Factory
    {
        $query = BlogCategory::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $blogcategories = $query->paginate($this->perPage);

        return view('livewire.admin.blog-category.index', ['blogcategories' => $blogcategories]);
    }
}
