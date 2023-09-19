<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ThankYou extends Component
{
    public $order;

    public function mount($id): void
    {
        $this->order = Order::findOrFail($id);
    }

    public function render(): View|Factory
    {
        return view('livewire.front.thank-you')->extends('layouts.app');
    }
}
