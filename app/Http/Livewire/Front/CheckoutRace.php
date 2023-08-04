<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Mail\CheckoutMail;
use App\Models\Order;
use App\Models\Participant;
use App\Models\Registration;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Enums\PaymentStatus;

class CheckoutRace extends Component
{
    use LivewireAlert;
    public $listeners = [
        'checkout'            => 'checkout',
        'checkoutCartUpdated' => '$refresh',
        'confirmed',
    ];
    public $removeFromCart;
    public $payment_method = 'card';
    public $total;
    public $status;
    public $cartTotal;
    public $subTotal;
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

    public function getParticipantProperty()
    {
        return Participant::where('user_id', Auth::user()->id)->first();
    }

    public function checkout()
    {
        if (Cart::instance('races')->count() === 0) {
            $this->alert('error', __('Your cart is empty'));
        }

        $cartItems = Cart::instance('races')->content();

        $order = null;

        foreach ($cartItems as $item) {
            $order = Order::create([
                'reference'      => Order::generateReference(),
                'payment_method' => $this->payment_method,
                'payment_status' => PaymentStatus::PENDING,
                'type'           => OrderType::REGISTRATION,
                'date'           => now(),
                'amount'         => $this->cartTotal,
                'user_id'        => Auth::user()->id,
                'race_id'        => $item->id,
                'status'         => OrderStatus::PENDING,
            ]);

            $registration = Registration::where('participant_id', Auth::user()->id)
                ->where('race_id', $item->id)
                ->first();

            if ($registration) {
                $registration->update(['order_id' => $order->id]);
            }

            Mail::to($order->user->email)->later(now()->addMinutes(10), new CheckoutMail($order, $order->user));
        }

        Cart::instance('races')->destroy();

        $this->alert('success', __('Order placed successfully!'));

        return redirect()->route('front.thankyou', $order->id);
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

    public function mount()
    {
        $subtotal = Cart::instance('races')->subtotal();

        $this->subTotal = str_replace(',', '', $subtotal);

        $this->cartTotal = $this->subTotal;
    }

    public function render(): View|Factory
    {
        return view('livewire.front.checkout-race')->extends('layouts.app');
    }
}
