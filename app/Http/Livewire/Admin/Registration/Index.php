<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Registration;

use App\Models\Race;
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
    public $selectedRace;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
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

   
    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Registration())->orderable;
        $this->activeTab = $this->activeTab ?? 'all';
    }

    public function showAllRegistrations()
    {
        $this->selectedRace = null;
        $this->showTab = false;
        $this->activeTab = 'all';
    }

    public function showRaceRegistrations($raceId)
    {
        $this->selectedRace = Race::findOrFail($raceId);
        $this->showTab = false;
        $this->activeTab = 'race';
    }

    public function showRaceParticipants($raceId)
    {
        $this->selectedRace = Race::findOrFail($raceId);
        $this->showTab = true;
        $this->activeTab = 'participant';
    }

    public function closeTab()
    {
        $this->showTab = false;
        $this->activeTab = 'race';
    }

    public function render(): View|Factory
    {
        $query = Registration::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        if ($this->activeTab === 'all') {
            $registrations = $query->paginate($this->perPage);
        } elseif ($this->activeTab === 'race') {
            $registrations = $query->where('race_id', $this->selectedRace->id)
                ->paginate($this->perPage);
        } else {
            $registrations = collect();
        }

        $racesWithRegistrations = Race::has('registrations')->get();

        return view('livewire.admin.registration.index', compact('registrations', 'racesWithRegistrations'))
            ->extends('layouts.dashboard');
    }

}