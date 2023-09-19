<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public $blogcategory;

    public $editModal = false;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'blogcategory.title'            => 'required|string|max:255',
        'blogcategory.description'      => 'nullable',
        'blogcategory.meta_title'       => 'nullable|max:100',
        'blogcategory.meta_description' => 'nullable|max:200',
    ];

    public function editModal($blogcategory): void
    {
        // abort_if(Gate::denies('blogcategory_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = BlogCategory::findOrFail($blogcategory);

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->blogcategory->language_id = 1;

        $this->blogcategory->save();

        $this->alert('success', __('BlogCategory updated successfully'));

        $this->editModal = false;

        $this->emit('refreshIndex');
    }

    public function render(): View
    {
        return view('livewire.admin.blog-category.edit');
    }
}
