<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductShow extends Component
{
    use LivewireAlert;

    public $product;

    public $relatedProducts;

    public $brand;

    public $category;

    public $quantity = 1;

    public $product_id;
    public $selectedSize = '';
    public $selectedColor = '';
    public $brand_products;

    public $decreaseQuantity;

    public $increaseQuantity;

    public function decreaseQuantity()
    {
        $this->quantity -= 1;
    }

    public function increaseQuantity()
    {
        $this->quantity += 1;
    }

    public function AddToCart($product_id)
    {
        $product = Product::find($product_id);

        Cart::instance('shopping')->add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => $this->quantity,
            'price'   => $product->price,
            'weight'  => 0,
            'options' => [
                'size'  => $this->selectedSize,
                'color' => $this->selectedColor,
            ],
        ])->associate('App\Models\Product');

        $this->emit('cartCountUpdated');

        $this->alert(
            'success',
            __('Product added to cart successfully!'),
            [
                'position'          => 'center',
                'timer'             => 3000,
                'toast'             => true,
                'text'              => '',
                'confirmButtonText' => 'Ok',
                'cancelButtonText'  => 'Cancel',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]
        );
    }

    public function mount(Product $product)
    {
        $this->product = $product;

        $this->brand_products = Product::active()->where('brand_id', $product->brand_id)->take(3)->get();
        $this->relatedProducts = Product::active()
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $this->brand = Brand::where('id', $product->brand_id)->first();
        $this->category = Category::where('id', $product->category_id)->first();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.product-show');
    }
}
