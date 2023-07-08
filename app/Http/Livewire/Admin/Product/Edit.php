<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Helpers;
// use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Product;
// use App\Models\Subcategory;
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

    public $image;

    public $images;

    public $category_id;

    public $gallery = [];

    public $width = 1000;

    public $height = 1000;

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
        // 'product.subcategories'    => ['nullable', 'array', 'min:1'],
        // 'product.subcategories.*'  => ['integer', 'distinct:strict'],
        'options'         => ['nullable', 'array'],
        'options.*.type'  => ['string', 'max:255'],
        'options.*.value' => ['string', 'max:255'],
        // 'product.brand_id'         => ['nullable', 'integer'],
        'product.embeded_video' => ['nullable'],
    ];

    public function onImagesUpdated($image): void
    {
        $this->images = $image;
    }

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function getImagePreviewProperty()
    {
        return $this->product?->image;
    }

    public function getCategoriesProperty()
    {
        return ProductCategory::select('id', 'name')
            ->get();
    }

    public function getBrandsProperty()
    {
        // return Brand::select('name', 'id')->get();
    }

    // public function getSubcategoriesProperty()
    // {
    //     return Subcategory::select('name', 'id')->get();
    // }

    // public function updatedProductSubcategories()
    // {
    //     $this->product->subcategories;
    // }

    public function addOption()
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function editModal($id)
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = Product::findOrFail($id);

        $this->description = $this->product->description;

        $this->options = json_decode($this->product->options) ?? [];

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Helpers::handleUpload($this->image, $this->width, $this->height, $this->product->name);

            $this->product->image = $imageName;
        }

        if ($this->gallery) {
            $gallery = [];

            foreach ($this->gallery as $key => $value) {
                $imageName = Helpers::handleUpload($value, $this->width, $this->height, $this->product->name);
                $gallery[] = $imageName;
            }

            $this->product->gallery = json_encode($gallery);
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
