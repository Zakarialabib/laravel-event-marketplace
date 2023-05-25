<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Races extends Component
{
    public function render()
    {
        return view('livewire.front.races')->extends('layouts.app');
    }
}
