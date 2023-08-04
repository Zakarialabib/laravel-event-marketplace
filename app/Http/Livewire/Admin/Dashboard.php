<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Race;
use App\Models\Registration;
use App\Models\Participant;
use App\Models\Subscriber;
use App\Models\Order;
use App\Models\Contact;

use Carbon\Carbon;

class Dashboard extends Component
{
    public $startDate;
    public $endDate;

    public function mount()
    {
        // Set default date range to the current month
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    public function render()
    {
        $productsCount = Product::whereBetween('created_at', [$this->startDate, $this->endDate])->count();
        $racesCount = Race::whereBetween('created_at', [$this->startDate, $this->endDate])->count();
        $participantsCount = Participant::whereBetween('created_at', [$this->startDate, $this->endDate])->count();
        $subscribersCount = Subscriber::whereBetween('created_at', [$this->startDate, $this->endDate])->count();
        $contactsCount = Contact::whereBetween('created_at', [$this->startDate, $this->endDate])->count();
        
        $registrationsCount = Registration::whereBetween('created_at', [$this->startDate, $this->endDate])->count();

        $ordersCount = Order::with('race')
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->count();

        $openRaces = Race::where('start_registration', '<', Carbon::now())
            ->count();

        $closedRaces = Race::where('end_registration', '<', Carbon::now())
            ->count();

        return view('livewire.admin.dashboard', compact(
            'productsCount',
            'racesCount',
            'registrationsCount',
            'participantsCount',
            'subscribersCount',
            'ordersCount',
            'contactsCount',
            'openRaces',
            'closedRaces'
        ))->extends('layouts.dashboard');
    }
}
