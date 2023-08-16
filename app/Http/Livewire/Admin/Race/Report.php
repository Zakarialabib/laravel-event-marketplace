<?php

namespace App\Http\Livewire\Admin\Race;

use App\Models\Race;
use App\Models\RaceLocation;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component
{
    use WithPagination;

    public $totalRaces, $upcomingRaces, $registrations;
    public $selected = [];
    public $selectAll = false;

    public $filters = [
        'statuses' => [],
        'location' => null,
        'search' => '',
        'dateFrom' => null,
        'dateTo' => null,
    ];

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->races->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function mount()
    {
       
        $this->totalRaces = Race::count();
        $this->upcomingRaces = Race::where('date', '>', now())->count();
        $this->registrations = Race::withCount('orders')->get()->sum('participants_count');
    }

    public function getLocationsProperty()
    {
        return RaceLocation::query()->get();    
    }

    public function resetFilters()
    {
        $this->filters = [
            'statuses' => [],
            'location' => null,
            'search' => '',
            'dateFrom' => null,
            'dateTo' => null,
        ];
    }



    public function render()
    {
        $query = Race::query();

        if ($this->filters['statuses']) {
            $query->whereIn('status', $this->filters['statuses']);
        }

        if ($this->filters['location']) {
            $query->where('race_location_id', $this->filters['location']);
        }

        if ($this->filters['search']) {
            $query->where('name', 'like', '%' . $this->filters['search'] . '%');
        }

        if ($this->filters['dateFrom']) {
            $query->whereDate('date', '>=', $this->filters['dateFrom']);
        }

        if ($this->filters['dateTo']) {
            $query->whereDate('date', '<=', $this->filters['dateTo']);
        }

        $races = $query->paginate(10);

        return view('livewire.admin.race.report', compact('races'))->extends('layouts.dashboard');
    }
}
