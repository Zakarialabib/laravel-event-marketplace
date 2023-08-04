<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Enums\PaymentStatus;
use App\Mail\CheckoutMail;
use App\Models\Order;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;

    public $listeners = [
        'checkoutCartUpdated' => '$refresh',
        'confirmed',
    ];

    public $decreaseQuantity;

    public $increaseQuantity;

    public $removeFromCart;
    public $cartTotal;
    public $shipping;
    public $payment_method = 'cash';
    public $shipping_id;
    public $productId;
    public $subTotal;

    public function confirmed()
    {
        Cart::instance('shopping')->remove($this->productId);
        $this->emit('cartCountUpdated');
        $this->emit('checkoutCartUpdated');
    }

    public function checkout()
    {
        $this->validate(['shipping_id' => 'required']);

        if (Cart::instance('shopping')->count() === 0) {
            return $this->alert('error', __('Your cart is empty'));
        }

        $cartItems = Cart::instance('shopping')->content();

        $order = null;

        foreach ($cartItems as $item) {
            $order = Order::create([
                'reference'       => Order::generateReference(),
                'payment_method'  => $this->payment_method,
                'payment_status'  => PaymentStatus::PENDING,
                'amount'          => Cart::instance('shopping')->total() + Shipping::find($this->shipping_id)->cost,
                'date'            => now(),
                'user_id'         => Auth::user()->id,
                'product_id'      => $item->id,
                'shipping_status' => OrderStatus::PENDING,
                'shipping_id'     => $this->shipping_id,
                'type'            => OrderType::PRODUCT,
                'status'          => OrderStatus::PENDING,
            ]);

            // Mail::to($order->user->email)->send(new CheckoutMail($order, $order->user));
        }

        if ($order) {
            Cart::instance('shopping')->destroy();
            $this->alert('success', __('Order placed successfully!'));

            return redirect()->route('front.thankyou', $order->id);
        }

        return $this->alert('error', __('Error occurred while placing the order'));
    }

    public function decreaseQuantity($rowId)
    {
        $cartItem = Cart::instance('shopping')->get($rowId);
        $qty = $cartItem->qty - 1;
        Cart::instance('shopping')->update($rowId, $qty);
        $this->emit('checkoutCartUpdated');
    }

    public function increaseQuantity($rowId)
    {
        $cartItem = Cart::instance('shopping')->get($rowId);
        $qty = $cartItem->qty + 1;
        Cart::instance('shopping')->update($rowId, $qty);
        $this->emit('checkoutCartUpdated');
    }

    public function removeFromCart($rowId)
    {
        $this->productId = $rowId;

        $this->confirm(
            __('Remove from cart ?'),
            [
                'position'          => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'confirm',
                'onConfirmed'       => 'confirmed',
                'showCancelButton'  => true,
                'cancelButtonText'  => 'cancel',
            ]
        );
    }

    public function getCartItemsProperty()
    {
        return Cart::instance('shopping')->content();
    }

    public function updateCartTotal()
    {
        $shipping_cost = $this->shipping ? $this->shipping->cost : 0;

        $this->cartTotal = $this->subTotal + $shipping_cost;
    }

    public function updatedShippingId($value)
    {
        $this->shipping = $value ? Shipping::find($value) : null;
        $this->updateCartTotal();
    }

    public function getShippingsProperty()
    {
        return Shipping::select('id', 'title', 'cost')->get();
    }

    public function mount()
    {
        $subtotal = Cart::instance('shopping')->subtotal();

        $this->subTotal = str_replace(',', '', $subtotal);
    }

    public function render()
    {
        return view('livewire.front.checkout')->extends('layouts.app');
    }
}
