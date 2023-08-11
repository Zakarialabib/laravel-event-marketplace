<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Registration;

use App\Exports\RegistrationExport;
use App\Models\Registration;
use App\Http\Livewire\WithSorting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;
    public array $orderable;
    public string $search = '';
    public array $selected = [];
    public array $paginationOptions;
    public $activeTab;
    public $registration;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortBy'        => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
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

    public function downloadSelected()
    {
        return (new RegistrationExport($this->selected))->download('registrations.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function downloadAll()
    {
        return (new RegistrationExport())->download('registrations.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Registration())->orderable;
        $this->activeTab ??= 'all';
    }

    public function showRegistration(Registration $registration)
    {
        $this->registration = $registration;
        $this->activeTab = 'showRegistration';
    }

    public function render(): View|Factory
    {
        $query = Registration::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $registrations = $query->paginate($this->perPage);

        return view('livewire.admin.registration.index', compact('registrations'))
            ->extends('layouts.dashboard');
    }
}
