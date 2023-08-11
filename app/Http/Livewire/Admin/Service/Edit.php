<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Service;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Service;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $service;

    public $image;

    public $listeners = [
        'editModal',
    ];

    public array $rules = [
        'service.name'        => 'required|min:3|max:255',
        'service.description' => 'required|min:3',
    ];

    public function editModal($service)
    {
        //abort_if(Gate::denies('service_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = Service::findOrFail($service);

        $this->editModal = true;
    }

    public function update()
    {
        //abort_if(Gate::denies('service_edit'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->service->name).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('services', $imageName);
            $this->service->image = $imageName;
        }

        $this->service->save();

        $this->editModal = false;

        $this->alert('success', __('Service updated successfully.'));
    }

    public function render(): View
    {
        return view('livewire.admin.service.edit');
    }
}
