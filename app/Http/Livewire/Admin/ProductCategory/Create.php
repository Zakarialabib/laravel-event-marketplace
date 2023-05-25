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

    public $listeners = ['createCategory'];

    public $createCategory;

    public $category;

    public $image;

    public array $rules = [
        'category.name' => 'required',
    ];

    public function mount(ProductCategory $category)
    {
        $this->category = $category;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.product-category.create');
    }

    public function createCategory()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createCategory = true;
    }

    public function create()
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->category->name).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('category', $imageName);
            $this->category->image = $imageName;
        }

        $this->category->save();

        $this->emit('refreshIndex');

        $this->alert('success', 'ProductCategory created successfully.');

        $this->createCategory = false;
    }
}
