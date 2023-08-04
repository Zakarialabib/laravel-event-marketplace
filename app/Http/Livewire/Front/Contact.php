<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Contact extends Component
{
    public function render(): View|Factory
    {
        return view('livewire.front.contact');
    }
}
