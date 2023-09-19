<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Currency;

use App\Http\Livewire\WithSorting;
use App\Models\Currency;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $currency;

    public int $perPage;

    public $listeners = [
        'showModal', 'editModal',
        'refreshIndex' => '$refresh',
    ];

    public $showModal = false;

    public $refreshIndex;

    public $editModal = false;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $selectPage;

    public array $rules = [
        'currency.name'          => 'required|string|max:255',
        'currency.code'          => 'required|string|max:255',
        'currency.symbol'        => 'required|string|max:255',
        'currency.exchange_rate' => 'required|numeric',
    ];

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
        $this->orderable = (new Currency())->orderable;
    }

    public function render()
    {
        abort_if(Gate::denies('currency_access'), 403);

        $query = Currency::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $currencies = $query->paginate($this->perPage);

        return view('livewire.currency.index', ['currencies' => $currencies]);
    }

    public function showModal(Currency $currency): void
    {
        abort_if(Gate::denies('currency_show'), 403);

        $this->currency = $currency;

        $this->showModal = true;
    }

    public function editModal(Currency $currency): void
    {
        abort_if(Gate::denies('currency_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->currency = $currency;

        $this->editModal = true;
    }

    public function update(Currency $currency): void
    {
        abort_if(Gate::denies('currency_edit'), 403);

        $this->validate();

        $this->currency->save();

        $this->showModal = false;

        $this->alert('success', __('Currency updated successfully!'));
    }

    public function delete(Currency $currency): void
    {
        abort_if(Gate::denies('currency_delete'), 403);

        $currency->delete();

        $this->alert('success', __('Currency deleted successfully!'));
    }
}
