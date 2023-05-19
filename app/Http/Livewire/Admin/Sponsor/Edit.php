<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Sponsor;

use App\Models\Sponsor;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $sponsor;

    public $editModal = false;

    public $image;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'sponsor.name'        => ['required', 'string', 'max:255'],
        'sponsor.slug'        => ['required', 'string'],
        'sponsor.description' => ['nullable', 'string'],
    ];

    public function getImagePreviewProperty()
    {
        return $this->sponsor?->image;
    }

    public function editModal($sponsor)
    {
        abort_if(Gate::denies('sponsor_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->sponsor = Sponsor::findOrfail($sponsor);

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('sponsor_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->sponsor->name).'-'.Str::random(5).'.'.$this->image->extension();

            // Delete the previous media file before updating
            $this->slider->clearMediaCollection('sponsors');

            $this->slider->addMediaFromDisk($this->image->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('sponsors');

            $this->sponsor->image = $imageName;
        }


        $this->sponsor->save();

        $this->alert('success', __('Sponsor updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.sponsors.edit');
    }
}
