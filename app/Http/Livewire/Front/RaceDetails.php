<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Race;

class RaceDetails extends Component
{

    public $race;

    public function mount($slug)
    {
        $this->race = Race::where('slug',$slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.front.race-details')->extends('layouts.app');
    }
}
