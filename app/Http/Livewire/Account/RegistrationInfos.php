<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\Registration;

class RegistrationInfos extends Component
{
    public $registrations;

    public function mount($participant): void
    {
        $this->registrations = Registration::where('participant_id', $participant->id)->get();
    }

    public function render()
    {
        return view('livewire.account.registration-infos');
    }
}
