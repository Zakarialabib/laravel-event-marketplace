<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ContactForm extends Component
{
    use LivewireAlert;

    public $contact;
    public $name;
    public $email;
    public $phone_number;
    public $message;

    protected $listeners = [
        'submit',
    ];

    protected $rules = [
        'contact.name'         => 'required',
        'contact.email'        => 'required|email',
        'contact.phone_number' => 'required',
        'contact.message'      => 'required',
    ];

    public function mount()
    {
        $this->contact = new Contact();
    }

    public function render()
    {
        return view('livewire.front.contact-form');
    }

    public function submit()
    {
        $this->validate();

        $this->contact->save();

        $this->alert('success', __('Your Message is sent succesfully.'));

        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        if ($admin) {
            Mail::to($admin->email)->later(now()->addMinutes(10), new ContactFormMail($this->contact));
        }

        $this->reset('name', 'email', 'phone_number', 'message');
    }
}
