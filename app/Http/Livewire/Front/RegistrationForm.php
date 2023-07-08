<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Models\Registration;
use App\Models\User;
use App\Models\Participant;
use App\Models\Subscriber;
use Spatie\Permission\Models\Role;
use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Auth;
use App\Enums\Status;
use Throwable;
use Illuminate\Support\Facades\Pipeline;
use App\Jobs\CreateUserParticipantCreds;
use Illuminate\Support\Str;

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
        'race.helthInformation'           => 'required',
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

        $participant = Registration::where('participant_id', Auth::id())->first();

        $this->existingSubmission = $participant ? $participant->registration : null;
    }

    public function render(): View|Factory
    {
        return view('livewire.front.registration-form');
    }

    public function register()
    {
        if ($this->existingSubmission) {
            $this->alert('error', __('You already have a submission'));

            return;
        }

        try {
            $this->validate();

          
            $participant = Pipeline::send($this->race)
            ->through([
                function ($race, $next) {
                    
                    $participantData = [
                        'name' => $race->firstName . ' ' . $race->lastName,
                        'email' => $race->email,
                        'phone_number' => $race->phoneNumber,
                        'gender' => $race->gender,
                        'country' => $race->country,
                        'birth_date' => $race->dateOfBirth,
                        'address' => $race->address,
                        'city' => $race->city,
                        'zip_code' => $race->zipCode,
                        'emergency_contact_name' => $race->emergencyContactName,
                        'emergency_contact_phone_number' => $race->emergencyContactPhoneNumber,
                        'health_informations' => $race->helthInformation,
                        'medical_history' => $race->hasMedicalHistory,
                        'taking_medications' => $race->isTakingMedications,
                        'medication_allergies' => $race->hasMedicationAllergies,
                        'sensitivities' => $race->hasSensitivities,
                        'race_location_id' => $race->race_location_id,
                    ];

                    $participant = Participant::create($participantData);
                    
                    if ($this->newsletters) {
                        Subscriber::create([
                            'email' => $participant->email,
                            'name' => $participant->name,
                            'tag' => 'participant', // 'participant' or 'subscriber
                            'status' => Status::ACTIVE,
                        ]);
                    }
                    
                    Cart::instance('shopping')->add($this->race->id)->associate('App\Models\Race');

                    return $next($participant);
                },    
                ])
                ->then(function ($participant) {
                    // dispatch job 
                return $participant;
            });

            $user = Pipeline::send($participant)
            ->through([
                function ($participant, $next) {

                    $random = Str::random(10);
                    $password = bcrypt($random);
                    
                    $user = new User();
                    
                    $user->name = $participant->name;
                    $user->email = $participant->email;
                    $user->password = $password;
                    
                    $user->save();
                    
                    $user->assignRole(Role::findByName('client'));

                    Auth::login($user, true);

                    if ($this->newsletters) {
                        Subscriber::create([
                            'email' => $participant->email,
                            'name' => $participant->name,
                            'tag' => 'participant', // 'participant' or 'subscriber
                            'status' => Status::ACTIVE,
                        ]);
                    }

                    // Mail::to($participant->email)->send(new RegistrationConfirmation($user));

                    return $next($participant, $user);
                },    
                ])
                ->then(function ($participant) {
                    
                return $participant;
                });

            $this->alert('success', __('Your order has been sent successfully!'));

            return redirect()->route('front.checkout-race');

        } catch (Throwable $th) {
            throw $th;
        }
    }

   
}
