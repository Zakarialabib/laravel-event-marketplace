<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Verify extends Component
{
    use LivewireAlert;

    public function resend(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            redirect(route('home'));
        }

        Auth::user()->sendEmailVerificationNotification();

        $this->emit('resent');

        $this->alert('success', __('Email resent please check your inbox!'));
    }

    public function render()
    {
        return view('livewire.auth.verify');
    }
}
