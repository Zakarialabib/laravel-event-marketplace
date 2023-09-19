<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Partner;

use App\Http\Livewire\WithSorting;
use App\Models\Partner;
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

    public $partner;

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
        return $this->partner?->image;
    }

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
        $this->orderable = (new Partner())->orderable;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('partner_access'), 403);

        $query = Partner::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $partners = $query->paginate($this->perPage);

        return view('livewire.admin.partner.index', ['partners' => $partners]);
    }

    public function showModal(Partner $partner): void
    {
        abort_if(Gate::denies('partner_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->partner = $partner;

        $this->showModal = true;
    }

    public function deleteModal($partner): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->partner = $partner;
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('partner_delete'), 403);

        Partner::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(): void
    {
        abort_if(Gate::denies('partner_delete'), 403);

        Partner::findOrFail($this->partner)->delete();

        $this->alert('success', __('Partner deleted successfully.'));
    }
}
