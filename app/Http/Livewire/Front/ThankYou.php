<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ThankYou extends Component
{
    //  show order details on thank you page

    public $order;

    public function mount($id)
    {
        $this->order = Order::findOrFail($id);
    }

    public function render(): View|Factory
    {
        return view('livewire.front.thank-you')->extends('layouts.app');
    }
}
