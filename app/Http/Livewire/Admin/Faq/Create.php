<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Faq;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $listeners = ['createModal'];

    public $createModal;

    public $faq;

    protected $rules = [
        'faq.name'        => ['required', 'max:255'],
        'faq.description' => ['required'],
    ];

    public function mount(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.faq.create');
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

        $this->faq->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Faq created successfully.'));

        $this->createModal = false;
    }
}
