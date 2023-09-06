<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\RaceLocation;

use App\Models\RaceLocation;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = ['createModal'];

    public $createModal;

    public $raceLocation;

    // public $image;

    protected $rules = [
        'raceLocation.name'        => ['required', 'max:255'],
        'raceLocation.description' => ['nullable'],
        'raceLocation.category_id' => ['required', 'integer'],
    ];

    public function mount(RaceLocation $raceLocation)
    {
        $this->raceLocation = $raceLocation;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.race-location.create');
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createModal = true;
    }

    public function create()
    {
        $this->validate();

        $this->raceLocation->slug = Str::slug($this->raceLocation->name);

        // if ($this->image) {
        //     $imageName = Str::slug($this->raceLocation->name).'.'.$this->image->extension();
        //     $this->raceLocation->addMedia($this->image)->toMediaCollection('local_files');
        //     $this->raceLocation->images = $imageName;
        // }

        $this->raceLocation->save();

        $this->emit('refreshIndex');

        $this->alert('success', 'RaceLocation created successfully.');

        $this->createModal = false;
    }
}
