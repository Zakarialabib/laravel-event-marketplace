<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AddToCart extends Component
{
    use LivewireAlert;

    public $product;

    public $product_id;

    public $selectedSize;
    public $selectedColor;
    public $quantity = 1;

    public $listeners = [
        'AddToCart',
        
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function AddToCart($product_id)
    {
        $product = Product::find($product_id);

        // 'options.*.type'
        // 'options.*.value'

        Cart::instance('shopping')->add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => $this->quantity,
            'price'   => $product->price,
            'options' => [
                'size'  => $this->selectedSize,
                'color' => $this->selectedColor,
            ],
        ])->associate('App\Models\Product');

        $this->emit('cartCountUpdated');

        // If the user cancels the confirmation, display a success message using Livewire's `alert` method
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

    public function render(): View|Factory
    {
        return view('livewire.front.add-to-cart');
    }
}

// @if ($product->options)
// <div class="mb-2">
//     <h4 class="text-base md:text-lg text-heading font-semibold mb-2.5 capitalize">
//         {{ __('Size') }}
//     </h4>
//     <ul class="flex flex-wrap">
//         @foreach ($product->options as $option)
//             @if ($option['type'] === 'size')
//                 <li
//                     class="cursor-pointer rounded border w-11 h-11 p-2 mb-2 md:mb-3 mr-2 md:mr-3 -3 flex justify-center items-center text-heading text-xs md:text-sm uppercase font-semibold transition duration-200 ease-in-out hover:border-black border-gray-100">
//                     <span class="block w-full h-full rounded">
//                         {{ $option['value'] }}
//                     </span>
//                 </li>
//             @endif
//         @endforeach
//     </ul>
// </div>

// <div class="mb-2">
//     <h4 class="text-base md:text-lg text-heading font-semibold mb-2.5 capitalize">
//         {{ __('Color') }}
//     </h4>
//     <ul class="flex flex-wrap">
//         @foreach ($product->options as $option)
//             @if ($option['type'] === 'color')
//                 <li
//                     class="cursor-pointer rounded border  w-9 md:w-11 h-9 md:h-11 p-1 mb-2 md:mb-3 mr-2 md:mr-3 flex justify-center items-center text-heading text-xs md:text-sm uppercase font-semibold transition duration-200 ease-in-out hover:border-black border-gray-100">
//                     <span class="block w-full h-full rounded"
//                         style="background-color: {{ $option['value'] }};"></span>
//                 </li>
//             @endif
//         @endforeach
//     </ul>
// </div>
// @endif

// <div>
//      @if ($product->status === true)
//          <a class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-green-400 hover:bg-green-200 transition cursor-pointer"
//              wire:click="AddToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
//              {{ __('Add to cart') }}
//          </a>
//      @else
//          <div class="text-sm font-bold">
//              <span class="text-red-500">● {{ __('Not available') }}</span>
//          </div>
//      @endif
//</div>
