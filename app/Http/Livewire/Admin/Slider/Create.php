<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createSlider = false;

    public $slider;

    public $image;
    public $description;

    public $listeners = [
        'createSlider',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public array $rules = [
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string'],
        'description'          => ['nullable'],
        'slider.link'          => ['nullable', 'string'],
        'slider.bg_color'      => ['nullable'],
        'slider.embeded_video' => ['nullable'],
        'image'                => ['required'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('slider_create'), 403);

        return view('livewire.admin.slider.create');
    }

    public function createSlider()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = new Slider();
        $this->description = '';

        $this->createSlider = true;
    }

    public function create()
    {
        try {
            $this->validate();

            if ($this->image) {
                $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->image->extension();

                $this->slider->addMediaFromDisk($this->image->getRealPath())
                    ->usingFileName($imageName)
                    ->toMediaCollection('local_files');

                $this->slider->image = $imageName;
            }
            $this->slider->language_id = 1;

            $this->slider->description = $this->description;

            $this->slider->save();

            $this->alert('success', __('Slider created successfully.'));

            $this->emit('refreshIndex');

            $this->createSlider = false;
        } catch (Throwable $th) {
            $this->alert('warning', __('An error happend Slider was not created.'));
        }
    }

}
