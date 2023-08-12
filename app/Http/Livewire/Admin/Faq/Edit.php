<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Faq;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Faq;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $faq;

    public $image;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'faq.name'        => ['required', 'max:255'],
        'faq.description' => ['required'],
    ];

    public function editModal($faq)
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->faq = Faq::findOrFail($faq);
        $this->editModal = true;
    }

    public function update()
    {
        //abort_if(Gate::denies('faq_edit'), 403);

        $this->validate();

        $this->faq->save();

        $this->alert('success', __('Faq updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.faq.edit');
    }
}
