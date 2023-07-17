<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\ProductCategory;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $category;

    public $image;

    public $listeners = [
        'editModal',
    ];

    public array $rules = [
        'category.name'        => 'required|min:3|max:255',
        'category.description' => 'required|min:3',
    ];

    public function editModal($category)
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->category = ProductCategory::findOrFail($category);

        $this->editModal = true;
    }

    public function update()
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->category->name).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('categories', $imageName);
            $this->category->image = $imageName;
        }

        $this->category->save();

        $this->editModal = false;

        $this->alert('success', __('ProductCategory updated successfully.'));
    }

    public function render(): View
    {
        return view('livewire.admin.product-category.edit');
    }
}
