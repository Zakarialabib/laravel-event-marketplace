<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\RaceLocation;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\RaceLocation;
use App\Models\Category;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $raceLocation;

    public $images;

    public $category_id = null;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'raceLocation.name'        => ['required', 'max:255'],
        'raceLocation.description' => ['required'],
        'raceLocation.category_id' => ['required', 'integer'],
    ];

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function editModal($raceLocation)
    {
        //abort_if(Gate::denies('raceLocation_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->raceLocation = RaceLocation::findOrFail($raceLocation);
        $this->images = $this->raceLocation->images;
        $this->editModal = true;
    }

    public function update()
    {
        //abort_if(Gate::denies('raceLocation_edit'), 403);

        $this->validate();

       
        if ($this->images) {
            $imageName = Str::slug($this->raceLocation->name).'.'.$this->images->extension();
            $this->raceLocation->addMedia($this->images)->toMediaCollection('local_files');        }

        $this->raceLocation->save();

        $this->alert('success', __('RaceLocation updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.race-location.edit');
    }
}
