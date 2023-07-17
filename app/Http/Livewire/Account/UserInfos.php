<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserInfos extends Component
{
    use LivewireAlert;

    public $user;

    protected function rules()
    {
        return [
            'user.email'    => 'required|email|unique:users,email,'.$this->user->id,
            'user.password' => 'required|min:6',
        ];
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.account.user-infos');
    }

    public function save()
    {
        $this->email = $this->user->email;

        if ($this->password !== '') {
            $this->user->password = bcrypt($this->password);
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
