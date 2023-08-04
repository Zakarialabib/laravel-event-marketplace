<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notification extends Component
{
    public $notifications = [];

    public function mount()
    {
        $user = Auth::user();
        $this->notifications = $user->unreadNotifications;
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
            $this->notifications = $this->notifications->reject(function ($item) use ($notificationId) {
                return $item->id === $notificationId;
            });
        }
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
