<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Registration;
use Gloudemans\Shoppingcart\Cart;
use App\Traits\CmiGateway;
use App\Support\Cmi;
use Exception;

class CheckoutController extends Controller
{
    use CmiGateway;

    public $order;

    public function __construct($order = null)
    {
        $this->order = $order;
    }

    public function initiateCmiPayment($id)
    {
        $this->order = Order::findOrFail($id);

        // dd($this->order->id);

        $registration = Registration::findOrFail($this->order->registration_id);

        // dd($registration);

        if ( ! $registration) {
            throw new Exception('Registration not found for the given user and race.');
        }

        $cmiClient = new Cmi();
        $cmiClient->setOid(date('dmY').rand(10, 1000));
        $cmiClient->setAmount($this->order->amount);
        $cmiClient->setBillToName($registration->name);
        $cmiClient->setEmail($registration->email);
        $cmiClient->setTel($registration->phone_number);
        $cmiClient->setCurrency('504');
        $cmiClient->setDescription('ceci est un exemple à utiliser');
        $cmiClient->setSessionTimeout(1800);
        $otherData = [
            'billToStreet1' => $registration->address,
            'billToCity'    => $registration->city,
            'billToCountry' => $registration->country,
            //etc...
        ];

        dd($cmiClient);

        return $this->requestPayment($cmiClient, $otherData);
    }

    public function okUrl()
    {
        $this->order->update([
            'status'         => OrderStatus::COMPLETED,
            'payment_status' => PaymentStatus::PAID,
        ]);

        Cart::instance('races')->destroy();

        return redirect()->route('front.thankyou', $this->order->id);
    }

    public function failUrl()
    {
        $this->order->update([
            'status'         => OrderStatus::FAILED,
            'payment_status' => PaymentStatus::PENDING,
        ]);

        $cmiClient = new Cmi();
        // withErrors(['payment' => __('Paiement échoué, une erreur est survenue lors de la transaction, veuillez réessayer ultérieurement.')]);
        return redirect($cmiClient->getShopUrl());
    }
}