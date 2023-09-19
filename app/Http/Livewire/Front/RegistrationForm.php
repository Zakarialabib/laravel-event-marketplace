<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\{Participant, Registration, Service, User};
use App\Enums\Status;
use App\Mail\RegistrationConfirmation;
use App\Models\Race;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Auth, DB, Mail, Cache};
use Illuminate\Support\Str;
use Livewire\Component;
use Throwable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Jobs\EmailSubscribtionJob;

class RegistrationForm extends Component
{
    use LivewireAlert;
    public $race;

    public $user;

    public $participant;

    public $registration;

    public $services;

    public $selectedServices = [];

    public $timeRemaining = 900;

    // 15 minutes in seconds
    public $additionalServices = false;

    public $existingSubmission;

    public $newsletters = false;

    public $team;

    public $isTeamRegistration = false;

    public $name;

    public $existingRegistration;

    public $rules = [
        'participant.email'                          => 'required|email:rfc,dns,spoof,filter|unique:participants,email',
        'participant.name'                           => 'required|string',
        'participant.gender'                         => 'required|string',
        'participant.birth_date'                     => 'required|date|before:today',
        'participant.phone_number'                   => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6|unique:participants,phone_number',
        'participant.country'                        => 'required|string|min:3|max:50',
        'participant.address'                        => 'required|string',
        'participant.city'                           => 'required|string|min:3|max:50',
        'participant.zip_code'                       => 'nullable|string',
        'participant.emergency_contact_name'         => 'nullable|string',
        'participant.emergency_contact_phone_number' => 'nullable|numeric|min:6',
        'participant.health_informations'            => 'required',
        'participant.medical_history'                => 'nullable',
        'participant.status'                         => 'nullable',
        'participant.taking_medications'             => 'nullable',
        'participant.medication_allergies'           => 'nullable',
        'participant.sensitivities'                  => 'nullable',
    ];

    public function mount($id): void
    {
        $this->race = Race::where('id', $id)->firstOrFail();
        $this->services = Service::all();

        $this->timeRemaining = Cache::get('registration_time_remaining', 900);

        if (Auth::check()) {
            $this->user = Auth::user();

            // Check if the authenticated user is a participant
            $this->participant = Participant::where('user_id', $this->user->id)->first();

            if ($this->participant) {
                $this->existingRegistration = Registration::where('participant_id', $this->participant->id)
                    ->where('race_id', $this->race->id)
                    ->first();
            } else {
                $this->participant = new Participant();
            }
        } else {
            $this->participant = new Participant();
        }
    }

    public function render(): View
    {
        return view('livewire.front.registration-form')->extends('layouts.app');
    }

    public function hydrate()
    {
        // Decrease the time remaining every second.
        --$this->timeRemaining;

        // If time expires
        if ($this->timeRemaining <= 0) {
            session()->flash('error', 'Your registration time has expired.');

            return redirect()->back();
        }
    }

    public function dehydrate(): void
    {
        Cache::put('registration_time_remaining', $this->timeRemaining, 900);
    }

    public function updatedIsTeamRegistration($value): void
    {
        $this->isTeamRegistration = $value;
    }

    public function register()
    {
        if ($this->existingRegistration) {
            $this->alert('error', __('You have already registered for this race. Check your account for details.'));

            return;
        }

        DB::beginTransaction();

        try {
            $this->validate();

            if ( ! $this->user) {
                $password = bcrypt(Str::random(10));

                $this->user = User::create([
                    'name'     => $this->participant['name'],
                    'email'    => $this->participant['email'],
                    'password' => $password,
                ]);

                $this->user->assignRole('client');
                Auth::login($this->user, true);
            }

            $this->participant->user_id = $this->user->id;
            $this->participant->save();

            $this->registration = new Registration();

            $this->registration->fill([
                'registration_number' => Str::uuid(),
                'participant_id'      => $this->participant['id'],
                'race_id'             => $this->race->id,
                'registration_date'   => now(),
                'status'              => Status::ACTIVE,
            ])->save();

            Mail::to($this->participant['email'])
                ->later(now()->addMinutes(10), new RegistrationConfirmation($this->participant));

            Cart::instance('races')
                ->add($this->race->id, $this->race->name, 1, $this->race->price)
                ->associate(Race::class);

            foreach ($this->selectedServices as $serviceId) {
                $service = Service::find($serviceId);
                Cart::instance('services')
                    ->add($service->id, $service->name, 1, $service->price)
                    ->associate(Service::class);
            }

            if ($this->newsletters) {
                EmailSubscribtionJob::dispatch($this->participant['email'], $this->participant['name']);
            }

            DB::commit();

            $this->alert('success', __('Your order has been sent successfully!'));

            return redirect()->route('front.checkout-race');
        } catch (Throwable $throwable) {
            DB::rollBack();

            throw $throwable;
        }
    }
}
