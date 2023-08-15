<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use App\Models\Slider;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal',
    ];

    public $editModal = false;

    public $slider;

    public $image;

    public $description;

    protected $rules = [
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string', 'max:255'],
        'description'          => ['nullable'],
        'slider.link'          => ['nullable', 'string'],
        'slider.bg_color'      => ['nullable', 'string'],
        'slider.embeded_video' => ['nullable'],
        'image'                => ['nullable'],
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function editModal($slider)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = Slider::find($slider);

        $this->description = $this->slider->description;

        $this->image = $this->slider->getMedia('local_files');

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        if (empty($this->image)) {
            $this->slider->addMedia($this->image->getRealPath())
                ->toMediaCollection('local_files');
        }

        $this->slider->language_id = 1;

        $this->slider->description = $this->description;

        $this->slider->save();

        $this->alert('success', __('Slider updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.slider.edit');
    }
}
