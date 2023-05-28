<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Resource;

class Resources extends Component
{

    public function getResourcesProperty()
    {
        return Resource::query()->get();
    }
    
    public function render()
    {
        return view('livewire.front.resources');
    }
}
