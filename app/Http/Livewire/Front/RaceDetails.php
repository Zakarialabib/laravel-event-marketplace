<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Race;

class RaceDetails extends Component
{
    public $race;
    public $existingRegistration;

    public function mount($slug)
    {
        $this->race = Race::where('slug', $slug)->firstOrFail();

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $participant = Participant::where('user_id', $user_id)->first();
            $this->existingRegistration = Registration::where('participant_id', $participant?->id)
                ->where('race_id', $this->race->id)
                ->first();
        }
    }

    public function render()
    {
        return view('livewire.front.race-details')->extends('layouts.app');
    }
}
