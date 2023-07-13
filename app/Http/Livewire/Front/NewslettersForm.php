<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Mail\SubscribedMail;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

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
        return view('livewire.front.newsletters');
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function subscribe()
    {
        $validatedData = $this->validate();
        
        try {
            
            $subscriber = Subscriber::create([
                'email' => $validatedData['email'],
                'name' => $this->extractNameFromEmail($validatedData['email']),
                'tag' => 'subscriber',
                'status' => 'active',
            ]);

            $this->alert('success', __('You are subscribed to our newsletters.'));

            $this->resetInputFields();

            $user = User::find(1);
            $user_email = $user->email;

            Mail::to($user_email)->send(new SubscribedMail($subscriber));
        } catch (Throwable $th) {
            $this->alert('error', __('Error') . $th->getMessage());
        }
    }

    private function extractNameFromEmail(string $email): string
    {
        $parts = explode('@', $email);
        $username = $parts[0];
        $nameParts = explode('.', $username);
        $name = implode(' ', $nameParts);
        return ucwords($name);
    }

    private function resetInputFields()
    {
        $this->email = '';
    }
}
