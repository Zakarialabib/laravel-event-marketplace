<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Throwable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ParticipantInfos extends Component
{
    
    use LivewireAlert;
    public $participant;

    public function render()
    {
        return view('livewire.account.participant-infos');
    }

    protected function rules()
    {
        return [
            'participant.email'                          => 'required|email|unique:participants,email,'.$this->participant->id,
            'participant.name'                           => 'required',
            'participant.phone_number'                   => 'required|min:6|unique:participants,phone_number,'.$this->participant->id,
            'participant.birth_date'                     => 'required|min:3',
            'participant.country'                        => 'required|min:3',
            'participant.city'                           => 'required|min:3',
            'participant.zip_code'                       => 'required',
            'participant.gender'                         => 'required',
            'participant.emergency_contact_name'         => 'required',
            'participant.emergency_contact_phone_number' => 'required|min:6',
            'participant.address'                        => 'required',
            'participant.health_informations'            => 'nullable',
            'participant.medical_history'                => 'nullable|boolean',
            'participant.taking_medications'             => 'nullable|boolean',
            'participant.medication_allergies'           => 'nullable|boolean',
            'participant.sensitivities'                  => 'nullable|boolean',
        ];
    }

    public function mount($participant)
    {
        $this->participant = $participant;
    }

    public function save()
    {
        try {
            $this->validate();

            $this->participant->save();

            $this->alert(
                'success',
                __('Participant information has been updated successfully!'),
                [
                    'position'          => 'center',
                    'timer'             => 3000,
                    'toast'             => true,
                    'text'              => '',
                    'confirmButtonText' => 'Ok',
                    'cancelButtonText'  => 'Cancel',
                    'showCancelButton'  => false,
                    'showConfirmButton' => false,
                ]
            );
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
