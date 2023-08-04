<div>

    <div class="px-10 py-6 bg-white border-b border-gray-200">
        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>

        <div class="mb-6 flex justify-center gap-4 items-center w-full">
            <label class="font-semibold">Date Range:</label>
            <input type="date" wire:model="startDate" class="border rounded px-2 py-1">
            <span class="mx-2">to</span>
            <input type="date" wire:model="endDate" class="border rounded px-2 py-1">
        </div>

        <div class="grid grid-cols-4 gap-6">
            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Products</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $productsCount }}</p>
            </div>

            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Races</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $racesCount }}</p>
            </div>
            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Registration</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $registrationsCount }}</p>
            </div>
            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Participants</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $participantsCount }}</p>
            </div>
            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Subscribers</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $subscribersCount }}</p>
            </div>
            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Orders</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $ordersCount }}</p>
            </div>
            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Contacts</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $contactsCount }}</p>
            </div>

            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Open Races</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $openRaces }}</p>
            </div>

            <div class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">Closed Races</h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $closedRaces }}</p>
            </div>
        </div>


        <div class="flex flex-row gap-4 mt-4 ">
            <div class="lg:w-1/2 md:w-full border bg-gray-50 p-2">
                <h3>{{ __('Recent Order(s)') }}</h3>
                <x-table>
                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th>{{ __('Order Number') }}</x-table.th>
                            <x-table.th>{{ __('Order Date') }}</x-table.th>
                        </x-table.tr>
                        <x-table.tbody>

                        </x-table.tbody>
                    </x-slot>
                </x-table>
            </div>

            <div class="lg:w-1/2 md:w-full border bg-gray-50 p-2">
                <h3>{{ __('Recent Registration') }}</h3>
                <x-table>
                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th>{{ __('Customer Email') }}</x-table.th>
                            <x-table.th>{{ __('Joined') }}</x-table.th>
                        </x-table.tr>
                    </x-slot>
                    <x-table.tbody>

                    </x-table.tbody>
                </x-table>
            </div>
        </div>

        <div class="my-4 bg-gray-100 shadow-md">
            @livewire('calendar')
        </div>
    </div>
</div>
