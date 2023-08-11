<div>
    @section('title', __('Races'))

    <section x-data="{ showSidebar: false }" class="relative table w-full bg-green-700 pt-16 px-4">
        <div class="grid grid-cols-1 text-center mt-10">
            <h3
                class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                {{ __('Races') }}
            </h3>
            <div class="text-center z-10 my-2 mx-3">
                <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-0 inline-block">
                    <li
                        class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-green-200">
                        <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        <span class="px-2 text-white"> > </span>
                    </li>
                    <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white hover:text-green-200"
                        aria-current="page">
                        <a href="{{ URL::Current() }}">
                            {{ __('Races') }}
                        </a>
                    </li>
                </ul>
                <div class="flex flex-wrap items-center py-5 text-white w-full sm:w-auto justify-center my-2">
                    <div
                        class="py-2 sm:px-3 flex flex-col justify-center gap-y-4 items-center font-heading font-medium">
                        <span>{{ __('Location') }}</span>
                        <select name="location_id" id="location_id" wire:model="raceLocation_id"
                            class="bg-transparent border border-gray-200 hover:border-gray-300 rounded-4xl">
                            <option value=""></option>
                            @foreach (Helpers::getActiveRaceLocations() as $location)
                                <option value="{{ $location->id }}">
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="py-2 sm:px-3 flex flex-col justify-center gap-y-4 items-center font-heading font-medium">
                        <span>{{ __('Race Type') }}</span>
                        <select name="category_id" id="category_id" wire:model="category_id"
                            class="bg-transparent border border-gray-200 hover:border-gray-300 rounded-4xl">
                            <option value=""></option>
                            @foreach (Helpers::getActiveCategories() as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="py-2 sm:px-3 flex flex-col justify-center gap-y-4 items-center font-heading font-medium">
                        <span>{{ __('Sorting') }}</span>
                        <select id="sortBy" wire:model="sorting"
                            class="bg-transparent border border-gray-200 hover:border-gray-300 rounded-4xl">
                            <option value=""></option>
                            @foreach ($sortingOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
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
    </section>

    <section class="w-full" x-data="{ loading: false }">
        <div class="flex flex-wrap items-center my-10 space-y-4">
            @foreach ($races as $race)
                <div class="relative w-full px-4">
                    <x-race-card :race="$race" view="wide" />
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-10" x-show="!loading && '{{ $races->hasMorePages() }}'">
            <div x-intersect="() => { $wire.loadMore(() => loading = false) }"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform translate-y-10"
                x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="flex items-center justify-center text-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4" fill="none"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM20 12a8 8 0 01-8 8v4c4.627 0 10-5.373 10-12h-4zm-2-5.291A7.962 7.962 0 0120 12h4c0-3.042-1.135-5.824-3-7.938l-3 2.647z">
                        </path>
                    </svg>
                    <span>{{ __('Loading...') }}</span>
                </div>
            </div>
        </div>
    </section>
</div>
