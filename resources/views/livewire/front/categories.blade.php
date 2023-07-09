<div>
    @section('title', $category_name ?? __('Categories'))

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta property="og:title" content="@if (isset($category_name)) {{ $category_name }} @endif">
        <meta property="og:url" content="{{ URL::current() }}">
    @endsection

    <section x-data="{ showSidebar: false }">
        <section class="relative table w-full bg-green-700 pt-16 pb-24">
            <div class="px-4">
                <div class="grid grid-cols-1 text-center mt-10">
                    <h3
                        class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                        @if (isset($category_name))
                            {{ $category_name }}
                        @else
                            {{ __('Categories') }}
                        @endif
                    </h3>
                    <div class="absolute text-center z-10 bottom-5 start-0 end-0 mx-3">
                        <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-0 inline-block">
                            <li
                                class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-green-200 pr-4">
                                <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                <span class="px-2 text-white"> > </span>
                            </li>
                            <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white hover:text-green-200"
                                aria-current="page">
                                @if (isset($category_name))
                                    <a href="{{ URL::Current() }}">
                                        {{ $category_name }}
                                    </a>
                                @endif
                            </li>
                        </ul>
                        <div class="w-full sm:w-auto flex justify-center my-2 overflow-x-scroll">
                            <button type="button" @click="showSidebar = true"
                                class="flex lg:hidden items-center justify-center w-12 h-12 duration-500 ease-in-out text-white hover:text-green-200">
                                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
            <div class="flex items-center justify-center -mt-2 pb-0.5 mb-4 md:mb-5 lg:mb-6 2xl:mb-7 3xl:mb-8">
                <h3 class="text-lg pt-5 md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                    {{ __('Race By Type') }}
                </h3>
            </div>
            <div x-data="{ swiper: null }" x-init="swiper = new Swiper($refs.container, {
                loop: true,
                slidesPerView: 'auto',
                spaceBetween: 0,
                grabCursor: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            })"
                class="relative w-10/12 mx-auto flex flex-row overflow-y-auto">
                <div class="absolute inset-y-0 left-0 z-10 flex items-center">
                    <button @click="swiper.slidePrev()"
                        class="bg-white -ml-2 lg:-ml-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-left w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="swiper-container" x-ref="container">
                    <div class="swiper-wrapper">
                        @foreach (Helpers::getActiveCategories() as $category)
                            <div class="swiper-slide w-auto px-4">
                                <div class="relative inline-flex mb-3.5 md:mb-4 lg:mb-5 xl:mb-6 mx-auto rounded-full">
                                    <button type="button" wire:click="filterType('category', {{ $category->name }})">
                                        <div class="flex">
                                            <span
                                                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                                                <span
                                                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; max-width: 100%;">
                                                    <img style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px;"
                                                        alt="" aria-hidden="true"
                                                        src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27180%27%20height=%27180%27/%3e"></span><img
                                                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                    decoding="async" data-nimg="intrinsic"
                                                    class="object-cover bg-gray-300 rounded-full"
                                                    style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 50%; max-width: 100%; min-height: 50%; max-height: 100%;"></span>
                                        </div>
                                        <h4
                                            class="text-heading text-sm md:text-base xl:text-lg font-semibold capitalize">
                                            {{ $category->name }}
                                        </h4>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 z-10 flex items-center">
                    <button @click="swiper.slideNext()"
                        class="bg-white -mr-2 lg:-mr-4 flex justify-center items-center w-10 h-10 rounded-full shadow focus:outline-none">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="chevron-right w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
        <section class="flex flex-wrap px-6 bg-gray-100">
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
                        @foreach (Helpers::getActiveCategories() as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('category', '{{ $category->name }}')">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-green-500 hover:underline">
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
                        @foreach (Helpers::getActiveRaceLocations() as $location)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('location', {{ $location->id }})">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-green-500 hover:underline">
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
                        @foreach (Helpers::getActiveCategories() as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('category', '{{ $category->name }}')">
                                    <span
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-green-500 hover:underline">
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
                                        class="inline-block px-2 py-2 text-sm font-bold font-heading text-green-500 hover:underline">
                                        {{ $location->name }} <small>
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="xl:w-3/4 md:w-full py-6" x-data="{ loading: false }" wire:loading.class.delay="opacity-50">
                <div class="mb-10 flex flex-wrap px-2 space-y-4" id="race-container">
                    @forelse ($races as $race)
                        <div class="xl:w-1/2 md:w-full px-4">
                            <x-race-card :race="$race" view="grid" />
                        </div>
                    @empty
                        <div class="w-full bg-gray-50 py-10 mb-10 px-4 shadow-xl">
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
        </section>
    </section>
</div>
