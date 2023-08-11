<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Enums\{OrderStatus, OrderType, PaymentStatus};
use App\Mail\CheckoutMail;
use App\Models\{Order, Participant, Registration};
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Traits\CmiGateway;

class CheckoutRace extends Component
{
    use LivewireAlert;
    use CmiGateway;
    public $listeners = [
        'checkout'            => 'checkout',
        'checkoutCartUpdated' => '$refresh',
        'confirmed',
    ];
    public $removeFromCart;
    public $payment_method = 'card';
    public $status;
    public $registration_subtotal;
    public $services_subtotal;
    public $registrationCartTotal;
    public $servicesCartTotal;
    public $raceId;
    public $registration;
    public $user;
    public $timeRemaining = 900; // 15 minutes in seconds

    public function mount()
    {
        $this->calculateCartTotals();
        $this->user = Auth::user();
    }

    public function hydrate()
    {
        // Decrease the time remaining every second.
        $this->timeRemaining--;

        // If time expires
        if ($this->timeRemaining <= 0) {
            $this->alert('error', 'Your registration time has expired.');

            return redirect()->back();
        }
    }

    public function dehydrate()
    {
        Cache::put('registration_time_remaining', $this->timeRemaining, 900);
    }

    public function calculateCartTotals()
    {
        $this->registration_subtotal = (float) str_replace(',', '', Cart::instance('races')->subtotal());
        $this->services_subtotal = (float) str_replace(',', '', Cart::instance('services')->subtotal());
    }

    public function confirmed()
    {
        Cart::instance('races')->remove($this->raceId);
        $this->emit('cartCountUpdated');
        $this->emit('checkoutCartUpdated');
    }

    public function getCartTotalProperty()
    {
        return $this->registration_subtotal + $this->services_subtotal;
    }

    public function getRegistrationCartItemsProperty()
    {
        return Cart::instance('races')->content();
    }

    public function getServicesCartItemsProperty()
    {
        return Cart::instance('services')->content();
    }

    public function getParticipantProperty()
    {
        return Participant::where('user_id', Auth::user()->id)->first();
    }

    public function checkout()
    {
        if (Cart::instance('races')->count() === 0) {
            $this->alert('error', __('Your cart is empty'));

            return;
        }

        if ($this->payment_method === 'card') {
            $this->processCardPayment();
        } else {
            $this->alert('success', __('Payment method not yet implemented'));
        }
    }

    protected function processCardPayment()
    {
        DB::transaction(function () {
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

                $this->linkOrderToRegistration($order, $item->id);
            }

            $this->redirect(route('cmi.pay', $order->id));
        });
    }

    protected function linkOrderToRegistration($order, $raceId)
    {
        $this->registration = Registration::where('participant_id', Auth::user()->id)
            ->where('race_id', $raceId)
            ->first();

        if ($this->registration) {
            $this->registration->order_id = $order->id;
            $this->registration->save();
        }

        Mail::to($order->user->email)->later(now()->addMinutes(10), new CheckoutMail($order, $order->user));

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

    public function render(): View|Factory
    {
        return view('livewire.front.checkout-race')->extends('layouts.app');
    }
}
