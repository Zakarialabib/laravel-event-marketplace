<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Enums\Status;
use App\Mail\SubscribeMail;
use App\Models\Subscriber;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class NewslettersForm extends Component
{
    use LivewireAlert;

    public $email;

    protected $listeners = [];

    protected $rules = [
        'email' => 'required|email|unique:subscribers,email',
    ];

    public function render(): View|Factory
    {
        return view('livewire.front.newsletters-form');
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function subscribe()
    {
        $validatedData = $this->validate();

        $subscriber = Subscriber::create([
            'email'  => $validatedData['email'],
            'name'   => $this->extractNameFromEmail($validatedData['email']),
            'tag'    => 'subscriber',
            'status' => Status::ACTIVE,
        ]);

        $this->alert('success', __('You are subscribed to our newsletters.'));

        Mail::to($validatedData['email'])->send(new SubscribeMail($subscriber));

        $this->reset('email');
    }

    private function extractNameFromEmail(string $email): string
    {
        $parts = explode('@', $email);
        $username = $parts[0];
        $nameParts = explode('.', $username);
        $name = implode(' ', $nameParts);

        return ucwords($name);
    }
}
