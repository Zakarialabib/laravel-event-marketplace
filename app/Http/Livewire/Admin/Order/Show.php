<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $order;

    public function mount($id): void
    {
        $this->order = Order::find($id);
    }

    public function render()
    {
        return view('livewire.admin.order.show')->extends('layouts.dashboard');
    }
}
