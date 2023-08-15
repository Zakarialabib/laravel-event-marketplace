<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createSubcategory;

    public $listeners = ['createSubcategory'];

    public $subcategory;

    public array $rules = [
        'subcategory.name'        => ['required', 'string', 'max:255'],
        'subcategory.category_id' => ['nullable', 'integer'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('subcategory_create'), 403);

        return view('livewire.admin.subcategory.create');
    }

    public function createSubcategory(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->subcategory = new Subcategory();

        $this->createSubcategory = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->subcategory->slug = Str::slug($this->subcategory->name);

        $this->subcategory->save();

        $this->alert('success', __('Subcategory created successfully.'));

        $this->emit('refreshIndex');

        $this->createSubcategory = false;
    }

    public function getCategoriesProperty()
    {
        return ProductCategory::select('name', 'id')->get();
    }
}
