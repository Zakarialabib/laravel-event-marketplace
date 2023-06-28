<div>
    @section('title', __('Categories'))

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta property="og:title"
            content="@if (isset($category_id)) {{ \App\Helpers::categoryName($category_id) }} @endif">
        <meta property="og:url" content="{{ URL::current() }}">
    @endsection

    <div x-data="{ showSidebar: false }">
        <section class="relative table w-full bg-redBrick-700 pt-16 pb-24">
            <div class="px-4">
                <div class="grid grid-cols-1 text-center mt-10">
                    <h3
                        class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                        @if (isset($category_id))
                            {{ \App\Helpers::categoryName($category_id) }}
                        @endif
                    </h3>
                    <div class="absolute text-center z-10 bottom-5 start-0 end-0 mx-3">
                        <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-0 inline-block">
                            <li
                                class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-redBrick-200 pr-4">
                                <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white hover:text-redBrick-200"
                                aria-current="page">
                                @if (isset($category_id))
                                    <a href="{{ URL::Current() }}">
                                        {{ \App\Helpers::categoryName($category_id) }}
                                    </a>
                                @endif
                            </li>
                        </ul>
                        <div class="w-full sm:w-auto flex justify-center my-2 overflow-x-scroll">
                            <button type="button" @click="showSidebar = true"
                                class="flex lg:hidden items-center justify-center w-12 h-12 duration-500 ease-in-out text-white hover:text-redBrick-200">
                                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!--end grid-->
            </div>
        </section>

        <div class="flex flex-wrap px-6 bg-gray-100">
            <!-- Mobile sidebar -->
            <div x-show="showSidebar" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full" @click.away="showSidebar = false"
                class="fixed top-0 left-0 bottom-0 bg-white z-50 w-5/6 max-w-sm lg:hidden px-6 pt-10 overflow-y-scroll"
                x-cloak>
                <div class="py-4" x-data="{ openCategory: true }">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-xl font-bold font-heading">{{ __('Category') }}</h3>
                        <button @click="openCategory = !openCategory">
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openCategory, 'fa-caret-down': !openCategory }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openCategory">
                        @foreach ($this->categories as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('category', {{ $category->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-redBrick-500 hover:underline">
                                        {{ $category->name }} <small>
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="border-t border-gray-900 mt-4 py-2"></div>
                <div class="py-4" x-data="{ openRaceLocation: true }">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-xl font-bold font-heading">{{ __('Location') }}</h3>
                        <button @click="openRaceLocation = !openRaceLocation">
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openRaceLocation, 'fa-caret-down': !openRaceLocation }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openRaceLocation">
                        @foreach ($this->raceLocations as $location)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('location', {{ $location->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-redBrick-500 hover:underline">
                                        {{ $location->name }} <small>
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="hidden lg:block w-1/4 py-6 px-2">
                <div class="mb-6 p-4 bg-gray-50" x-data="{ activeOnly: true }">
                    <div class="flex space-y-2 flex-col items-center justify-center mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Filters') }}</h3>
                        <select
                            class="px-5 py-3 mr-2 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                            id="sortBy" wire:model.lazy="sorting">
                            <option disabled>{{ __('Choose filters') }}</option>
                            @foreach ($sortingOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex space-y-2 flex-col items-center justify-center">
                        <h3 class="text-xl font-bold font-heading">{{ __('Races') }}</h3>
                        <div class="flex flex-row space-x-2">
                            <label for="status" class="text-xs text-gray-700">{{ __('COMING') }}</label>
                            <div
                                class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" name="status" id="status"
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    wire:model.lazy="status">
                                <label for="status"
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                            <label for="status" class="text-xs text-gray-700">{{ __('PAST') }}</label>
                        </div>
                    </div>
                </div>

                <div class="mb-6 p-4 bg-gray-50" x-data="{ openCategory: true }">
                    <div class="flex justify-between mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Category') }}</h3>
                        <button @click="openCategory = !openCategory">
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openCategory, 'fa-caret-down': !openCategory }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openCategory">
                        @foreach ($this->categories as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('category', {{ $category->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-redBrick-500 hover:underline">
                                        {{ $category->name }} <small>
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-6 p-4 bg-gray-50" x-data="{ openRaceLocation: true }">
                    <div class="flex justify-between mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Location') }}</h3>
                        <button @click="openRaceLocation = !openRaceLocation">
                            <i class="fa fa-caret-down"
                                :class="{ 'fa-caret-up': openRaceLocation, 'fa-caret-down': !openRaceLocation }"
                                aria-hidden="true">
                            </i>
                        </button>
                    </div>
                    <ul x-show="openRaceLocation">
                        @foreach ($this->raceLocations as $location)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('location', {{ $location->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-redBrick-500 hover:underline">
                                        {{ $location->name }} <small>
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="w-full lg:w-3/4 py-6 px-4" x-data="{ loading: false }" wire:loading.class.delay="opacity-50">
                <div class="mb-10 grid grid-cols-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6 md:gap-4" id="race-container">
                    @forelse ($races as $race)
                        <x-race-card :race="$race" view="grid" />
                    @empty
                        <div class="col-span-full bg-gray-50 py-10 mb-10 w-full px-4 shadow-xl">
                            <h3 class="text-3xl text-center font-bold font-heading text-blue-900">
                                {{ __('No Races found') }}
                            </h3>
                        </div>
                    @endforelse
                </div>
                @if ($races)
                    <div class="flex justify-center mt-10" x-show="!loading && '{{ $races->hasMorePages() }}'">
                        <div x-intersect="() => { $wire.loadMore(() => loading = false) }"
                            x-transition:enter="transition ease-out duration-1000"
                            x-transition:enter-start="opacity-0 transform translate-y-10"
                            x-transition:enter-end="opacity-100 transform translate-y-0">
                            <div class="flex items-center justify-center text-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4" fill="none"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM20 12a8 8 0 01-8 8v4c4.627 0 10-5.373 10-12h-4zm-2-5.291A7.962 7.962 0 0120 12h4c0-3.042-1.135-5.824-3-7.938l-3 2.647z">
                                    </path>
                                </svg>
                                <span>{{ __('Loading...') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>