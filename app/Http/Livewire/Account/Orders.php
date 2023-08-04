<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $user = User::find(Auth::user()->id);

        $this->orders = Order::where('user_id', $user->id)->get();
    }

    public function render()
    {
        return view('livewire.account.orders');
    }
}
