<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account;

use App\Models\User;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $user;
    public $registrations;
    public $participant;

    public function mount()
    {
        $this->user = User::find(Auth::user()->id);

        $this->participant = Participant::where('user_id', $this->user->id)->first();

        // $this->registrations = $this->participant->registrations;
    }

    public function render()
    {
        return view('livewire.account.index')->extends('layouts.app');
    }
}
