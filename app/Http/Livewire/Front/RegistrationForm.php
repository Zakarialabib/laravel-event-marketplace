<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Helpers;
use App\Models\Registration;
use App\Models\Race;
use App\Enums\OrderType;
use App\Enums\Status;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class RegistrationForm extends Component
{
    use LivewireAlert;

    public $name;

    public $phone;

    public $address;

    public $registration;

    protected $rules = [
        'numberOfParticipants' => 'required|integer',
        'email' => 'required|email',
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'gender' => 'required|string',
        'dateOfBirth' => 'required|date',
        'phoneNumber' => 'required|string',
        'country' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'zipCode' => 'nullable|string',
        'emergencyContactName' => 'required|string',
        'emergencyContactPhoneNumber' => 'required|string',
        'hasMedicalHistory' => 'boolean',
        'isTakingMedications' => 'boolean',
        'hasMedicationAllergies' => 'boolean',
        'hasSensitivities' => 'boolean',
    ];


    public function mount($race)
    {
        $this->race = $race;
        $this->registration = new Registration();
        $this->country = 'Maroc';
    }

    public function render(): View|Factory
    {
        return view('livewire.front.order-form');
    }

    public function store()
    {

        $this->validate();

        $this->registration-save();

        $this->alert('success', __('Your order has been sent successfully!'));

        // Mail::to(Helpers::settings('company_email_address'))->send(new OrderFormMail($order));

        $this->reset();
    }
}
