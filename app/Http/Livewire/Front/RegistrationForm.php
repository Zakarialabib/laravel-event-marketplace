<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
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
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

class RegistrationForm extends Component
{
    use LivewireAlert;

    public $race;

    public $registration;

    public $participant;

    public $additionalServices = false;

    public $existingSubmission;
    public $newsletters = false;

    protected $rules = [
        'race.numberOfParticipants'        => 'required|integer',
        'race.email'                       => 'required|email:rfc,dns,spoof,filter|unique:participants,email',
        'race.firstName'                   => 'required|string',
        'race.lastName'                    => 'required|string',
        'race.gender'                      => 'required|string',
        'race.dateOfBirth'                 => 'required|date|before:today',
        'race.phoneNumber'                 => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6|unique:participants,phone_number',
        'race.country'                     => 'required|string|min:3|max:50',
        'race.address'                     => 'required|string',
        'race.city'                        => 'required|string|min:3|max:50',
        'race.zipCode'                     => 'nullable|string',
        'race.emergencyContactName'        => 'nullable|string',
        'race.emergencyContactPhoneNumber' => 'nullable|numeric|min:6',
        'race.helthInformation'            => 'required',
        'race.hasMedicalHistory'           => 'nullable|boolean',
        'race.isTakingMedications'         => 'nullable|boolean',
        'race.hasMedicationAllergies'      => 'nullable|boolean',
        'race.hasSensitivities'            => 'nullable|boolean',
    ];

    public function mount($race)
    {
        $this->race = $race;
        $this->registration = new Registration();
        $this->country = 'Maroc';

        $this->participant = Registration::where('participant_id', Auth::id())->first();

        $this->existingSubmission = $this->participant ? $this->participant->registration : null;
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

                        if ( ! Auth::check()) {

                            $random = Str::random(10);
                            $password = bcrypt($random);

                            $user = new User();

                            $user->name = $race->firstName.' '.$race->lastName;
                            $user->email = $race->email;
                            $user->password = $password;

                            $user->save();

                            $user->assignRole(Role::findByName('client'));

                        } else {
                            $user = Auth::user();
                        }

                        Auth::login($user, true);

                        $participantData = [
                            'name'                           => $race->firstName.' '.$race->lastName,
                            'email'                          => $race->email,
                            'phone_number'                   => $race->phoneNumber,
                            'gender'                         => $race->gender,
                            'country'                        => $race->country,
                            'birth_date'                     => $race->dateOfBirth,
                            'address'                        => $race->address,
                            'city'                           => $race->city,
                            'zip_code'                       => $race->zipCode,
                            'emergency_contact_name'         => $race->emergencyContactName,
                            'emergency_contact_phone_number' => $race->emergencyContactPhoneNumber,
                            'health_informations'            => $race->helthInformation,
                            'medical_history'                => $race->hasMedicalHistory,
                            'taking_medications'             => $race->isTakingMedications,
                            'medication_allergies'           => $race->hasMedicationAllergies,
                            'sensitivities'                  => $race->hasSensitivities,
                            'race_location_id'               => $race->race_location_id,
                            'user_id'                        => $user->id,
                        ];

                        $participant = Participant::create($participantData);

                        $this->registration->participant_id = $participant->id;
                        $this->registration->race_id = $this->race->id;
                        $this->registration->registration_date = date('Y-m-d H:i:s');
                        $this->registration->status = Status::ACTIVE;
                        $this->registration->save();

                        // Mail::to($participant->email)->send(new RegistrationConfirmation($user));
                        // Cart::instance('races')->add($this->race->id)->associate('App\Models\Race');

                        return $next($participant);
                    },
                ])
                ->then(function ($participant) {
                    return $participant;
                });

            $user = Pipeline::send($participant)
                ->through([
                    function ($participant, $next) {

                        if ($this->newsletters) {
                            $existingSubscriber = Subscriber::where('email', $this->participant->email)->first();

                            if ( ! $existingSubscriber) {
                                Subscriber::create([
                                    'email'  => $participant->email,
                                    'name'   => $this->participant->name,
                                    'tag'    => 'participant', // 'participant' or 'subscriber
                                    'status' => Status::ACTIVE,
                                ]);
                            }
                        }

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
