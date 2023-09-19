<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $category;

    public $images;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'category.name'        => ['required', 'max:255'],
        'category.description' => ['required'],
    ];

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function editModal($category): void
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->category = Category::findOrFail($category);
        $this->images = $this->category->images;
        $this->editModal = true;
    }

    public function update(): void
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->validate();

        if ($this->images) {
            $this->category->clearMediaCollection('local_files');

            $this->category->addMedia($this->images)->toMediaCollection('local_files');
        }

        $this->category->save();

        $this->alert('success', __('Category updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.category.edit');
    }
}
