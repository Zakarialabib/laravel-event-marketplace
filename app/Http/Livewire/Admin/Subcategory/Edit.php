<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Subcategory;
use App\Models\ProductCategory;

class Edit extends Component
{
    use LivewireAlert;

    public $listeners = [
        'editModal',
    ];

    public array $rules = [
        'subcategory.name'        => ['required', 'string', 'max:255'],
        'subcategory.category_id' => ['nullable', 'integer'],
        'subcategory.slug'        => ['required'],
    ];

    public $subcategory;

    public $editModal = false;

    public function editModal($id): void
    {
        // abort_if(Gate::denies('subcategory_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->subcategory = Subcategory::findOrfail($id);

        $this->editModal = true;
    }

    public function update(): void
    {
        // abort_if(Gate::denies('subcategory_update'), 403);

        $this->validate();

        $this->subcategory->save();

        $this->editModal = false;

        $this->alert('success', __('Subcategory updated successfully'));
    }

    public function render()
    {
        return view('livewire.admin.subcategory.edit');
    }

    public function getCategoriesProperty()
    {
        return ProductCategory::select('name', 'id')->get();
    }
}
