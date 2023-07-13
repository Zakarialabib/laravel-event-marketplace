<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Mail\CheckoutMail;
use App\Mail\CustomerRegistrationMail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CheckoutRace extends Component
{
    use LivewireAlert;

    public $listeners = [
        'checkout'            => 'checkout',
        'checkoutCartUpdated' => '$refresh',
        'confirmed',
    ];

    public $removeFromCart;

    public $payment_method = 'cash';

    public $total;

    public $status;

    public $cartTotal;

    public $raceId;

    public function confirmed()
    {
        Cart::instance('races')->remove($this->raceId);
        $this->emit('cartCountUpdated');
        $this->emit('checkoutCartUpdated');
    }

    public function getCartItemsProperty()
    {
        return Cart::instance('races')->content();
    }

    public function getSubTotalProperty()
    {
        return Cart::instance('races')->subtotal();
    }

    public function checkout()
    {

        if (Cart::instance('races')->count() === 0) {
            $this->alert('error', __('Your cart is empty'));
        }

        $order = Order::create([
            'reference'        => Order::generateReference(),            
            'payment_method'   => $this->payment_method,
            'payment_status'   => PaymentStatus::PENDING,
            'type'              => OrderType::RACE,
            'date'              => now(),
            'amount'            => $this->cartTotal,
            'user_id'          => auth()->user()->id,
            // 'race_id'          => $
            'status'     => OrderStatus::PENDING,
        ]);

        Mail::to($order->user->email)->send(new CheckoutMail($order, $user));

        Cart::instance('races')->destroy();

        $this->alert('success', __('Order placed successfully!'));

        return redirect()->route('front.thankyou', ['order' => $order->id]);
    }

    public function removeFromCart($rowId)
    {
        $this->raceId = $rowId;

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

    public function getCartTotalProperty()
    {
        return Cart::instance('races')->total();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.checkout-race')->extends('layouts.app');
    }
}
