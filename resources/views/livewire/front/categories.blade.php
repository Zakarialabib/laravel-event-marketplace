@section('meta')
    <meta itemprop="url" content="{{ URL::current() }}">
    <meta property="og:title"
        content="@if (isset($category_id)) {{ \App\Helpers::categoryName($category_id) }} @endif">
    <meta property="og:url" content="{{ URL::current() }}">
@endsection

<div>
    <div class="w-full px-4 mx-auto" x-data="{ showSidebar: false }">
        <div class="mb-4 items-center justify-between  py-2">
            <div class="w-full md:px-4 sm:px-2 flex flex-wrap justify-center items-center">
                <a href="{{ URL::current() }}" class="text-gray-600 font-bold uppercase text-5xl hover:text-blue-500">
                    @if (isset($category_id))
                        {{ \App\Helpers::categoryName($category_id) }}
                    @endif

                    
                </a>

                <div class="md:w-auto flex flex-wrap justify-center my-2 space-x-4 space-y-2 px-4">

                    <button type="button" @click="showSidebar = true"
                        class="flex lg:hidden items-center justify-center w-12 h-12 text-gray-600 hover:text-redBrick-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                </div>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3">
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
            <div class="hidden lg:block w-1/4 px-3">
                <div class="mb-6 p-4 bg-gray-50" x-data="{ activeOnly: true }">
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

                <div class="mb-6 p-4 bg-gray-50">
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
            <div class="w-full lg:w-3/4 px-4" x-data="{ loading: false }">
                <div class="mb-10 space-y-10" id="race-container">
                    @forelse ($races as $race)
                        <div
                            class="flex flex-wrap items-center bg-gray-50 pt-5 pb-15 rounded-lg w-full px-4 md:-mx-4 shadow-2xl bg-white shadow-2xl">
                            <div class="w-full lg:w-1/3 h-full mb-6 flex justify-center">
                                <a href="{{ route('front.raceDetails', $race->slug) }}">
                                <img class="object-cover object-center w-full rounded-xl h-72 lg:h-96"
                                    src="{{ $race->getFirstMediaUrl('local_files') }}" alt="{{ $race->name }}">
                                </a>
                                <a href="{{ route('front.raceDetails', $race->slug) }}"
                                    class="cursor-pointer absolute bottom-0 inline-flex items-center md:text-lg bg-redBrick-600 py-6 px-8 front-bold rounded-full text-white hover:bg-redBrick-800 hover:text-redBrick-200 focus:bg-redBrick-800 font-semibold">
                                    <span class="mr-3">{{ __('Check race') }}</span>
                                    <svg width="8" height="10" viewbox="0 0 8 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.94667 4.74665C7.91494 4.66481 7.86736 4.59005 7.80666 4.52665L4.47333 1.19331C4.41117 1.13116 4.33738 1.08185 4.25617 1.04821C4.17495 1.01457 4.08791 0.997253 4 0.997253C3.82246 0.997253 3.6522 1.06778 3.52667 1.19331C3.46451 1.25547 3.4152 1.32927 3.38156 1.41048C3.34792 1.4917 3.33061 1.57874 3.33061 1.66665C3.33061 1.84418 3.40113 2.01445 3.52667 2.13998L5.72667 4.33331H0.666667C0.489856 4.33331 0.320286 4.40355 0.195262 4.52858C0.070238 4.6536 0 4.82317 0 4.99998C0 5.17679 0.070238 5.34636 0.195262 5.47138C0.320286 5.59641 0.489856 5.66665 0.666667 5.66665H5.72667L3.52667 7.85998C3.46418 7.92196 3.41458 7.99569 3.38074 8.07693C3.34689 8.15817 3.32947 8.24531 3.32947 8.33331C3.32947 8.42132 3.34689 8.50846 3.38074 8.5897C3.41458 8.67094 3.46418 8.74467 3.52667 8.80665C3.58864 8.86913 3.66238 8.91873 3.74361 8.95257C3.82485 8.98642 3.91199 9.00385 4 9.00385C4.08801 9.00385 4.17514 8.98642 4.25638 8.95257C4.33762 8.91873 4.41136 8.86913 4.47333 8.80665L7.80666 5.47331C7.86736 5.40991 7.91494 5.33515 7.94667 5.25331C8.01334 5.09101 8.01334 4.90895 7.94667 4.74665Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="w-full lg:w-1/2 md:px-4 py-10">

                                <p
                                    class="block mb-4 leading-6 text-gray-800 hover:text-gray-900 font-bold hover:underline">
                                    {{ $race->date }}
                                </p>
                                <a class="inline-block mb-4 text-2xl font-medium leading-6 text-gray-800 hover:text-gray-900 font-bold hover:underline"
                                    href="{{ route('front.raceDetails', $race->slug) }}">{{ $race->name }}</a>
                                <div class="mb-4">
                                    <span class="text-sm md:text-base font-medium text-gray-500">Race Location:</span>
                                    <span class="text-base md:text-lg">{{ $race?->location->name }}</span>
                                </div>

                                <div class="mb-4">
                                    <span class="text-sm md:text-base font-medium text-gray-500">Category:</span>
                                    <span class="text-base md:text-lg">{{ $race?->category->name }}</span>
                                </div>

                                <div class="mb-4">
                                    <span class="text-sm md:text-base font-medium text-gray-500">Number of Days:</span>
                                    <span class="text-base md:text-lg">{{ $race->number_of_days }}</span>
                                </div>

                                <div class="mb-4">
                                    <span class="text-sm md:text-base font-medium text-gray-500">Number of
                                        Racers:</span>
                                    <span class="text-base md:text-lg">{{ $race->number_of_racers }}</span>
                                </div>

                                <div class="mb-4">
                                    <span class="text-sm md:text-base font-medium text-gray-500">Price:</span>
                                    <span class="text-base md:text-lg">{{ $race->price }} DH</span>
                                </div>

                                @if ($race->social_media)
                                    <div class="mb-4">
                                        <x-theme.social-media-icons :socialMedia="$race->social_media" />
                                    </div>
                                @else
                                    <p class="block text-base md:text-lg text-gray-400">No social media available.</p>
                                @endif

                                @if ($race->course)
                                    <div class="mb-7">
                                        <ul>
                                            @foreach (json_decode($race->course) as $key => $course)
                                                <li class="text-base inline-flex gap-2 md:text-lg">
                                                    <span
                                                        class="text-xs uppercase px-[10px] py-[5px] tracking-widest whitespace-nowrap inline-block rounded-md bg-redBrick-500 hover:bg-redBrick-800 text-white">
                                                        {{ ucfirst($key) }}
                                                        </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="block text-base md:text-lg text-gray-400">No course details available.
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-50 py-10 mb-10 rounded-lg w-full px-4 md:-mx-4 shadow-2xl">
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
