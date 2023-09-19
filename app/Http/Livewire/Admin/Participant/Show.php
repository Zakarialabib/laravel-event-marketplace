<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Participant;

use App\Models\Participant;
use App\Models\Order;
use App\Models\Registration;
use Livewire\Component;

class Show extends Component
{
    public $participant;

    public $orders;

    public $registrations;

    public function mount($id): void
    {
        $this->participant = Participant::find($id);
        $this->orders = Order::where('user_id', $this->participant->user_id)->get();
        $this->registrations = Registration::where('participant_id', $this->participant->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.participant.show')->extends('layouts.dashboard');
    }
}
