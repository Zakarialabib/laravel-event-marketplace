<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserInfos extends Component
{
    use LivewireAlert;

    public $user;

    public $email;

    protected function rules(): array
    {
        return [
            'user.email'    => 'required|email|unique:users,email,'.$this->user->id,
            'user.password' => 'required|min:6',
        ];
    }

    public function mount($user): void
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.account.user-infos');
    }

    public function save(): void
    {
        $this->email = $this->user->email;

        if ($this->user->password !== '') {
            $this->user->password = bcrypt($this->user->password);
        }

        $this->user->update();

        $this->alert(
            'success',
            __('your account has been updated successfully!'),
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
    }
}
