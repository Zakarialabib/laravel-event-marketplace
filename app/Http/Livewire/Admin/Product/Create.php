<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Product;
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

    public $listeners = [
        'createProduct',
        'imagesUpdated' => 'onImagesUpdated',
    ];

    public $createProduct = false;

    public $product;

    public $images;

    public $options = [];

    public $description = '';

    public array $listsForFields = [];

    protected $rules = [
        'product.name'             => ['required', 'string', 'max:255'],
        'product.price'            => ['required', 'numeric', 'max:2147483647'],
        'product.discount_price'   => ['required', 'numeric', 'max:2147483647'],
        'description'              => ['nullable'],
        'product.meta_title'       => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.category_id'      => ['required', 'integer'],
        // 'product.subcategories'    => ['required', 'array', 'min:1'],
        // 'product.subcategories.*'  => ['integer', 'distinct:strict'],
        'options.*.type'        => ['required', 'string', 'in:color,size'],
        'options.*.value'       => ['required_if:options.*.type,color', 'string'],
        'product.brand_id'      => ['nullable', 'integer'],
        'product.embeded_video' => ['nullable'],
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    // public function updatedProductSubcategories()
    // {
    //     $this->product->subcategories()->sync($this->product->subcategories);
    // }
    public function onImagesUpdated($images): void
    {
        $this->images = $images;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.product.create');
    }

    public function createProduct()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = new Product();

        $this->createProduct = true;
    }

    public function create()
    {
        $this->validate();

        $this->product->code = Str::slug($this->product->name, '-');

        $this->product->slug = Str::slug($this->product->name);

        if ($this->images) {
            foreach ($this->images as $image) {
                $this->product->addMedia($image->getRealPath())->toMediaCollection('local_files');
            }
        }

        // $this->product->subcategories = $this->subcategories;
        $this->product->description = $this->description;
        $this->product->options = $this->options;

        $this->product->save();

        $this->alert('success', 'Product created successfully');

        $this->emit('refreshIndex');

        $this->createProduct = false;
    }

    public function getCategoriesProperty()
    {
        return ProductCategory::select('name', 'id')->get();
    }

    public function getBrandsProperty()
    {
        return Brand::select('name', 'id')->get();
    }

    // public function getSubcategoriesProperty()
    // {
    //     return Subcategory::select('name', 'id')->get();
    // }
}
