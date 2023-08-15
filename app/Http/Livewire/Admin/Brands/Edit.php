<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $brand;

    public $editModal = false;

    public $images;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'brand.name'        => ['required', 'string', 'max:255'],
        'brand.slug'        => ['required', 'string'],
        'brand.description' => ['nullable', 'string'],
    ];

    public function editModal($brand): void
    {
        abort_if(Gate::denies('brand_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->brand = Brand::findOrfail($brand);

        $this->editModal = true;
    }

    public function update(): void
    {
        abort_if(Gate::denies('brand_update'), 403);

        $this->validate();

        if ($this->images) {
            $imageName = Str::slug($this->brand->name).'.'.$this->brand->extension();

            $this->brand->addMedia($this->images)->toMediaCollection('local_files');

            $this->brand->images = $imageName;
        }

        $this->brand->save();

        $this->alert('success', __('Brand updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.brands.edit');
    }
}
