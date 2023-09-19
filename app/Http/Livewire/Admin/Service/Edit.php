<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Service;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Service;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public $editModal = false;

    public $service;

    public $listeners = [
        'editModal',
    ];

    public array $rules = [
        'service.name'        => 'required|min:3|max:255',
        'service.description' => 'nullable',
        'service.price'       => 'required|min:3',
    ];

    public function editModal($service): void
    {
        //abort_if(Gate::denies('service_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = Service::findOrFail($service);

        $this->editModal = true;
    }

    public function update(): void
    {
        //abort_if(Gate::denies('service_edit'), 403);

        $this->validate();

        $this->service->save();

        $this->editModal = false;

        $this->alert('success', __('Service updated successfully.'));
    }

    public function render(): View
    {
        return view('livewire.admin.service.edit');
    }
}
