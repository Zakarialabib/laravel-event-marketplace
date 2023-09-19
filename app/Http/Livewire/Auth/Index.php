<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Index extends Component
{
    public $isStoreOwner = true;

    protected $listeners = ['storeOwnerChanged' => 'hideLoginForm'];

    public function hideLoginForm(): void
    {
        $this->isStoreOwner = false;
    }

    public function render()
    {
        return view('livewire.auth.index');
    }
}
