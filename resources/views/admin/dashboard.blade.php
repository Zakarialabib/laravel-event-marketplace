@section('title', __('Dashboard'))
<x-dashboard-layout>
 
    {{-- @livewire('media-library') --}}

    <div>
        <div class="bg-white">
            <div class="md:inline-flex float-right pt-2 pb-5 sm:flex sm:flex-wrap">
                <x-button type="button" primary data-date="today" class="js-date mr-2 active">
                    {{ __('Today') }}
                </x-button>

                <x-button type="button" primary data-date="month" class="js-date mr-2">
                    {{ __('Last month') }}
                </x-button>

                <x-button type="button" primary data-date="semi" class="js-date mr-2">
                    {{ __('Last 6 month') }}
                </x-button>

                <x-button type="button" primary data-date="year" class="js-date">
                    {{ __('Last year') }}
                </x-button>
            </div>
            @foreach ($customData as $key => $d)
                @if ($loop->first)
                    <div class="w-full flex flex-wrap align-center mb-4 js-date-row" id="{{ $key }}">
                        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 w-full">
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Customers') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['countCustomers'] }} --}}
                                    </p>
                                </div>
                            </div>
                            <div
                            class="flex items-center p-4 bg-white rounded-lg shadow-md">
                            <div>
                                <p class="mb-2 text-lg font-medium text-gray-600">
                                    {{ __('Orders') }}
                                </p>
                                <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                    {{-- {{ $d['ordersCount'] }} --}}
                                </p>
                            </div>
                        </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Pending') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['orderPending'] }} --}}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Processing') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['orderProcessing'] }} --}}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Completed') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['orderCompleted'] }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="w-full flex flex-wrap align-center mb-4 js-date-row" style="display: none"
                        id="{{ $key }}">
                        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 w-full">
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Customers') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['countCustomers'] }} --}}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['ordersCount'] }} --}}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Processing') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['orderProcessing'] }} --}}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Completed') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['orderCompleted'] }} --}}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{-- {{ $d['ordersCount'] }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
