<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Sponsor;

use App\Http\Livewire\WithSorting;
use App\Imports\PartnersImport;
use App\Models\Sponsor;
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

    public $sponsor;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 
        'delete',
    ];

    public $deleteModal = false;

    public $showModal = false;

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

    public function getImagePreviewProperty()
    {
        return $this->sponsor?->image;
    }

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

    public function confirmed()
    {
        $this->emit('delete');
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Sponsor())->orderable;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('sponsor_access'), 403);

        $query = Sponsor::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $sponsors = $query->paginate($this->perPage);

        return view('livewire.admin.sponsors.index', compact('sponsors'));
    }

    public function showModal(Sponsor $sponsor)
    {
        abort_if(Gate::denies('sponsor_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->sponsor = $sponsor;

        $this->showModal = true;
    }

    public function deleteModal($sponsor)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->sponsor = $sponsor;
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('sponsor_delete'), 403);

        Sponsor::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete()
    {
        abort_if(Gate::denies('sponsor_delete'), 403);

        Sponsor::findOrFail($this->sponsor)->delete();

        $this->alert('success', __('Sponsor deleted successfully.'));
    }

}
