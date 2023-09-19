<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use Throwable;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember_me = false;

    protected array $rules = [
        'email'    => 'required|email',
        'password' => '',
    ];

    public function authenticate()
    {
        try {
            $this->validate();

            if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
                $user = User::where(['email' => $this->email])->first();

                auth()->login($user, $this->remember_me);

                $homePage = match (true) {
                    $user->hasRole('admin') => RouteServiceProvider::ADMIN_HOME,
                    default                 => RouteServiceProvider::CLIENT_HOME,
                };

                return redirect()->intended($homePage);
            }
        } catch (Throwable) {
            $this->addError('email', __('These credentials do not match our records'));
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
