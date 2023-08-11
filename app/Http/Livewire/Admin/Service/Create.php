<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $listeners = ['createModal'];

    public $createModal;

    public $service;

    public array $rules = [
        'service.name'        => 'required|min:3|max:255',
        'service.description' => 'nullable',
        'service.price' => 'required|min:3',
    ];

    public function render(): View|Factory
    {
        return view('livewire.admin.service.create');
    }

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = new Service();

        $this->createModal = true;
    }

    public function create()
    {
        $this->validate();

        $this->service->save();

        $this->emit('refreshIndex');

        $this->alert('success', 'Service created successfully.');

        $this->createModal = false;
    }
}
