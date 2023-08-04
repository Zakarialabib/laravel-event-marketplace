<div>
    <div x-data="{ openNotification: false }">
        <button @click="openNotification = !openNotification" type="button"
            class="relative group px-6">
            <i class="fas fa-bell text-gray-600"></i>
            <span class="absolute top-0 right-2 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white rounded-full px-2 py-1">
                {{ count($notifications) }}
            </span>
        </button>

        <div x-show="openNotification" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
            @click.away="openNotification = false" class="absolute h-auto right-0 top-0 mt-12 w-96 bg-white shadow-lg p-4">
            <h4 class="text-xl font-semibold mb-4">Notifications</h4>
            @foreach ($notifications as $notification)
                <div class="mb-4">
                    <p>{{ $notification->data['message'] }}</p>
                    <button wire:click="markAsRead('{{ $notification->id }}')"
                        class="text-blue-500 hover:underline">Mark as Read</button>
                </div>
            @endforeach
            @if (count($notifications) === 0)
                <p class="text-gray-500">No new notifications.</p>
            @endif
        </div>
    </div>
</div>
