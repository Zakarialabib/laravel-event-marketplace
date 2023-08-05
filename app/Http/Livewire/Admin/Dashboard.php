<?php

declare(strict_types=1);

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

        $recentOrders = Order::select('created_at', 'amount', 'reference', 'id')->orderBy('created_at', 'desc')->take(10)->get();

        $recentRegistrations = Registration::with('participant')->select('participant_id', 'created_at', 'id')->orderBy('created_at', 'desc')->take(10)->get();

        $openRaces = Race::where('start_registration', '<', Carbon::now())
            ->count();

        $closedRaces = Race::where('end_registration', '<', Carbon::now())
            ->count();

        return view('livewire.admin.dashboard', compact(
            'productsCount',
            'racesCount',
            'recentOrders',
            'recentRegistrations',
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
