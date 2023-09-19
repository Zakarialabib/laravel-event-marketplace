<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $product;

    public $editModal = false;

    public $images;

    public $category_id;

    public $description;

    public $options = [];

    public $listeners = [
        'optionUpdated' => 'updatedOptions',
        'imagesUpdated' => 'onImagesUpdated',
        'editModal',
    ];

    protected $rules = [
        'product.code'             => ['nullable'],
        'product.slug'             => ['nullable'],
        'product.name'             => ['required', 'string', 'max:255'],
        'product.price'            => ['required', 'numeric', 'max:2147483647'],
        'product.discount_price'   => ['nullable', 'numeric', 'max:2147483647'],
        'description'              => ['nullable'],
        'product.meta_title'       => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.category_id'      => ['required', 'integer'],
        'product.subcategories'    => ['nullable', 'array', 'min:1'],
        'product.subcategories.*'  => ['integer', 'distinct:strict'],
        'options'                  => ['nullable', 'array'],
        'options.*.type'           => ['string', 'max:255'],
        'options.*.value'          => ['string', 'max:255'],
        'product.brand_id'         => ['nullable', 'integer'],
        'product.embeded_video'    => ['nullable'],
    ];

    public function onImagesUpdated($image): void
    {
        $this->images = $image;
    }

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function updatedProductSubcategories($value): void
    {
        $this->product->subcategories = $value;
    }

    public function addOption(): void
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index): void
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function editModal($id): void
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = Product::findOrFail($id);

        $this->description = $this->product->description;
        // $this->subcategories = $this->product->subcategories;

        $this->options = json_decode((string) $this->product->options, true) ?? [];

        $this->images = $this->product->images;

        $this->editModal = true;
    }

    public function update(): void
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->validate();

        if ($this->images) {
            $this->product->clearMediaCollection('local_files');

            foreach ($this->images as $image) {
                $this->product->addMedia($image->getRealPath())->toMediaCollection('local_files');
            }
        }

        $this->product->description = $this->description;
        $this->product->options = $this->options;

        $this->product->save();

        $this->alert('success', __('Product updated successfully.'));

        $this->editModal = false;

        $this->emit('refreshIndex');
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.product.edit');
    }
}
