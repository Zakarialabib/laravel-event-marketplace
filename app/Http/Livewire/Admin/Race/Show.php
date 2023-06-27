<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Models\Race;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Show extends Component
{
    public $race;

    public $listeners = [
        'showModal',
    ];

    public $showModal = false;

    public function showModal($id)
    {
        abort_if(Gate::denies('race_show'), 403);

        $this->race = Race::findOrFail($id);

        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.admin.race.show');
    }
}
