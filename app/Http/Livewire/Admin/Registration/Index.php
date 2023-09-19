<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Registration;

use App\Exports\RegistrationExport;
use App\Models\Registration;
use App\Models\Race;
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

    public $selectedRace = '';

    public $activeTab;

    public $registration;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortBy'        => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'selectedRace'  => ['except' => ''],
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

    public function downloadSelected()
    {
        return (new RegistrationExport($this->selected))->download('registrations.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function downloadAll()
    {
        return (new RegistrationExport())->download('registrations.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Registration())->orderable;
        $this->activeTab = 'all';
    }

    public function showRegistration(Registration $registration): void
    {
        $this->registration = $registration;
        $this->activeTab = 'showRegistration';
    }

    public function updatingSelectedRace(): void
    {
        $this->resetPage();
    }

    public function getRacesProperty()
    {
        return Race::select('name', 'id')->get();
    }

    public function render(): View|Factory
    {
        $query = Registration::with('race')->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        if ($this->selectedRace) {
            $query->whereHas('race', function ($subQuery): void {
                $subQuery->where('name', $this->selectedRace);
            });
        }

        $registrations = $query->paginate($this->perPage);

        return view('livewire.admin.registration.index', ['registrations' => $registrations])
            ->extends('layouts.dashboard');
    }
}
