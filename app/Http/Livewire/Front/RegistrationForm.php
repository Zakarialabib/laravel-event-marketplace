<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Helpers;
use App\Models\Registration;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Auth;
use App\Enums\Status;

class RegistrationForm extends Component
{
    use LivewireAlert;

    public $race;

    public $registration;
    
    public $additionalServices = false;

    public $existingSubmission;
    public $newsletters = false;

    protected $rules = [
        'race.numberOfParticipants'        => 'required|integer',
        'race.email'                       => 'required|email',
        'race.firstName'                   => 'required|string',
        'race.lastName'                    => 'required|string',
        'race.gender'                      => 'required|string',
        'race.dateOfBirth'                 => 'required|date',
        'race.phoneNumber'                 => 'required|string',
        'race.country'                     => 'required|string',
        'race.address'                     => 'required|string',
        'race.city'                        => 'required|string',
        'race.zipCode'                     => 'nullable|string',
        'race.emergencyContactName'        => 'required|string',
        'race.emergencyContactPhoneNumber' => 'required|string',
        'race.hasMedicalHistory'           => 'boolean',
        'race.isTakingMedications'         => 'boolean',
        'race.hasMedicationAllergies'      => 'boolean',
        'race.hasSensitivities'            => 'boolean',
    ];

    public function mount($race)
    {
        $this->race = $race;
        $this->registration = new Registration();
        $this->country = 'Maroc';

        $this->existingSubmission = Registration::where('user_id', Auth::id())
                                                ->first();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.registration-form');
    }

    public function store()
    {

        if ($this->existingSubmission) {
            $this->alert('error', __('You already have a submission'));
            return;
        }

        try {
            
            $this->validate();

            $this->registration->save();

            $user = User::create([
                'name'     => $this->registration->first_name.' '.$this->registration->last_name,
                'email'    => $this->registration->email,
                'phone'    => $this->registration->phone,
                'city'     => $this->registration->city,
                'country'  => $this->registration->country,
                'status'   => Status::INACTIVE, // Set status to inactive by default
            ]);
    
            $role = Role::create(['name' => 'client']);
    
            $user->assignRole($role);
            
            // Generate a random password for the user
            $password = Str::random(10);
            $user->password = bcrypt($password);
            $user->save();

            event(new Registered($user));
    
            Auth::login($user, true);

            if($this->newsletters){
                Newsletters::create([
                    'email' => $this->registration->email,
                ]);
            }
            
            Mail::to($this->registration->email)->send(new RegistrationConfirmation($user, $password));

            $this->alert('success', __('Your order has been sent successfully!'));

            $this->reset();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
