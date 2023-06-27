<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Race;

class Calendar extends Component
{
    public $year;
    public $month;
    public $events = [];

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->month = Carbon::now()->month;
        $this->fetchEvents();
    }

    public function fetchEvents()
    {
        $startOfMonth = Carbon::createFromDate($this->year, $this->month, 1)->startOfDay();
        $endOfMonth = Carbon::createFromDate($this->year, $this->month, 1)->endOfMonth()->endOfDay();

        $this->events = Race::with('location')->whereBetween('date', [$startOfMonth, $endOfMonth])->get();
    }

    public function previousMonth()
    {
        $this->month = Carbon::createFromDate($this->year, $this->month, 1)->subMonth()->month;
        $this->year = Carbon::createFromDate($this->year, $this->month, 1)->year;
        $this->fetchEvents();
    }

    public function nextMonth()
    {
        $this->month = Carbon::createFromDate($this->year, $this->month, 1)->addMonth()->month;
        $this->year = Carbon::createFromDate($this->year, $this->month, 1)->year;
        $this->fetchEvents();
    }

    public function render()
    {
        return view('livewire.calendar', [
            'calendar' => $this->getCalendar(),
        ]);
    }

    public function getCalendar()
    {
        $startOfMonth = Carbon::createFromDate($this->year, $this->month, 1);
        $endOfMonth = Carbon::createFromDate($this->year, $this->month, 1)->endOfMonth();

        $calendar = [];

        while ($startOfMonth->lte($endOfMonth)) {
            $calendar[] = [
                'date'   => $startOfMonth->copy(),
                'events' => $this->events->where('date', $startOfMonth->toDateString()),
            ];

            $startOfMonth->addDay();
        }

        return $calendar;
    }
}
