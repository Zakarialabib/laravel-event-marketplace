<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = ['createModal'];

    public $createModal;

    public $category;

    public $image;

    public array $rules = [
        'category.name' => 'required|min:3|max:255',
        'category.description' => 'required|min:3',
    ];

    public function render(): View|Factory
    {
        return view('livewire.admin.product-category.create');
    }

    public function createModal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->category = new ProductCategory();

        $this->createModal = true;
    }

    public function create()
    {
        $this->validate();

        $this->category->slug = Str::slug($this->category->name);

        if ($this->image) {
            $imageName = Str::slug($this->category->name).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('category', $imageName);
            $this->category->image = $imageName;
        }

        $this->category->save();

        $this->emit('refreshIndex');

        $this->alert('success', 'ProductCategory created successfully.');

        $this->createModal = false;
    }
}
