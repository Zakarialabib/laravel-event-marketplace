<div>
    @section('title', __('Dashboard'))
    <div class="px-10 py-6 bg-white border-b border-gray-200">
        <h1 class="text-3xl font-semibold mb-6">{{ __('Dashboard') }}</h1>

        <div class="mb-6 flex justify-center gap-4 items-center w-full">
            <label class="font-semibold">{{ __('Date Range') }}:</label>
            <input type="date" wire:model="startDate" class="border rounded px-2 py-1">
            <span class="mx-2">to</span>
            <input type="date" wire:model="endDate" class="border rounded px-2 py-1">
        </div>

        <div class="grid grid-cols-4 gap-6">
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.products') }}">
                        {{ __('Products') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $productsCount }}</p>

            </div>

            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.races') }}">
                        {{ __('Races') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">{{ $racesCount }}
                </p>

            </div>
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.registrations') }}">
                        {{ __('Registration') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $registrationsCount }}</p>

            </div>
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.participants') }}">
                        {{ __('Participants') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $participantsCount }}</p>

            </div>
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.products') }}">
                        {{ __('Subscribers') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $subscribersCount }}</p>

            </div>
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.orders') }}">
                        {{ __('Orders') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $ordersCount }}</p>
            </div>
            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.products') }}">
                        {{ __('Contacts') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $contactsCount }}</p>

            </div>

            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.products') }}">
                        {{ __('Open Races') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $openRaces }}
                </p>
            </div>

            <div
                class="relative flex items-center px-4 py-2 bg-white rounded-lg shadow-md justify-between border border-blue-400">
                <h2 class="text-lg font-semibold">
                    <a class="hover:text-blue-400 hover:underline focus:text-blue-400"
                        href="{{ route('admin.products') }}">
                        {{ __('Closed Races') }}
                    </a>
                </h2>
                <p class="text-3xl absolute right-0 px-4 py-2 rounded-lg bg-blue-400 text-white">
                    {{ $closedRaces }}
                </p>
            </div>
        </div>


        <div class="flex flex-row gap-4 mt-4 ">
            <div class="lg:w-1/2 md:w-full border bg-gray-50 p-2">
                <h3>{{ __('Recent Orders') }}</h3>
                <x-table>
                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th>{{ __('Ref') }}</x-table.th>
                            <x-table.th>{{ __('Amount') }}</x-table.th>
                            <x-table.th>{{ __('Date') }}</x-table.th>
                        </x-table.tr>
                        <x-table.tbody>
                            @foreach ($recentOrders as $order)
                                <x-table.tr wire:key="{{ $order->id }}">
                                    <x-table.td>
                                        <a href="{{ route('admin.order.show', $order->id) }}">
                                            {{ $order->reference }}
                                        </a>
                                    </x-table.td>
                                    <x-table.td>{{ Helpers::format_currency($order->amount) }}</x-table.td>
                                    <x-table.td>{{ Helpers::format_date($order->created_at) }}</x-table.td>
                                </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-slot>
                </x-table>
            </div>

            <div class="lg:w-1/2 md:w-full border bg-gray-50 p-2">
                <h3>{{ __('Recent Registration') }}</h3>
                <x-table>
                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th>{{ __('Infos') }}</x-table.th>
                            <x-table.th>{{ __('Joined') }}</x-table.th>
                        </x-table.tr>
                    </x-slot>
                    <x-table.tbody>
                        @foreach ($recentRegistrations as $registration)
                            <x-table.tr wire:key="{{ $registration->id }}">
                                <x-table.td>
                                    <a href="{{ route('admin.participant.show', $registration->participant->id) }}">
                                        {{ $registration->participant->name }} <br>
                                        {{ $registration->participant->email }} <br>
                                        {{ $registration->participant->phone_number }}
                                    </a>
                                </x-table.td>
                                <x-table.td>{{ Helpers::format_date($registration->created_at) }}</x-table.td>
                            </x-table.tr>
                        @endforeach
                    </x-table.tbody>
                </x-table>
            </div>
        </div>

        <div class="my-4 bg-gray-100 shadow-md">
            @livewire('calendar')
        </div>
    </div>
</div>
