<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
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

    public $createModal;

    public $brand;

    public $images;

    public $listeners = [
        'createModal',
        'imagesUpdated' => 'onImagesUpdated',
    ];

    protected $rules = [
        'brand.name'        => ['required', 'string', 'max:255'],
        'brand.description' => ['nullable', 'string'],
    ];

    public function onImagesUpdated($image): void
    {
        $this->images = $image;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('brand_create'), 403);

        return view('livewire.admin.brands.create');
    }

    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->brand = new Brand();

        $this->createModal = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->brand->slug = Str::slug($this->brand->name);

        if ($this->images) {
            $imageName = Str::slug($this->brand->name).'.'.$this->brand->extension();

            $this->brand->addMedia($this->images)->toMediaCollection('local_files');

            $this->brand->images = $imageName;
        }

        $this->brand->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Brand created successfully.'));

        $this->createModal = false;
    }
}
