<div>
    @section('title', __('Catalog'))

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta property="og:title" content="{{ __('Catalog') }}">
        <meta property="og:url" content="{{ URL::current() }}">
    @endsection

    <div x-data="{ showSidebar: false }">
        <section class="relative table w-full bg-green-700 py-16">
            <div class="px-4">
                <div class="grid grid-cols-1 text-center mt-10">
                    <h3
                        class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                        {{ __('Catalog of products') }}
                    </h3>
                    <div class="text-center z-10 my-2">
                        <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-0 inline-block">
                            <li
                                class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-white">
                                <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                <span class="px-2 text-white"> > </span>
                            </li>
                            <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white"
                                aria-current="page">
                                <a href="{{ URL::Current() }}">
                                    {{ __('Catalog of products') }}
                                </a>
                                <span class="px-2 text-white"> > </span>
                            </li>
                        </ul>
                        <div class="w-full sm:w-auto flex justify-center my-2">
                            <button type="button" @click="showSidebar = true"
                                class="flex lg:hidden items-center justify-center w-12 h-12 duration-500 ease-in-out text-white hover:text-green-200">
                                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <select
                                class="px-5 py-3 mr-2 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                                id="sortBy" wire:model="sorting">
                                <option disabled>{{ __('Choose filters') }}</option>
                                @foreach ($sortingOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <select
                                class="px-5 py-3 mr-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                                id="perPage" wire:model="perPage">
                                <option value="20" selected>20 {{ __('Items') }}</option>
                                <option value="50">50 {{ __('Items') }}</option>
                                <option value="100">100 {{ __('Items') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="hidden lg:block mb-6 md:mb-0">
            <div class="flex items-center justify-center -mt-2 pb-0.5 mb-4 md:mb-5 lg:mb-6 2xl:mb-7 3xl:mb-8">
                <h3 class="text-lg pt-5 md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                    {{ __('Shop By Category') }}
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
            })" class="relative w-10/12 mx-auto flex flex-row mb-6">
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
                        @foreach (Helpers::getActiveProductCategories() as $category)
                            <div class="swiper-slide w-auto px-4">
                                <div x-data="{ active: '{{ $category->id }}' === '{{ $category_id }}' }" x-init="$watch('active', value => value ? $wire.category_id = '{{ $category->id }}' : '')"
                                    class="relative inline-flex mx-auto rounded-full">
                                    <button type="button"
                                        @class="{ 'border-2 border-black bg-opacity-30': active, 'border': !active }"
                                        wire:click="filterType('category', '{{ $category->id }}')">
                                        <div
                                            class="flex items-center justify-center w-32 h-32 rounded-full bg-gray-300">
                                            <h4 class="text-base text-white font-semibold capitalize">
                                                {{ $category->name }}
                                            </h4>
                                        </div>
                                    </button>
                                    @if ($category_id == $category->id)
                                        <div class="absolute top-0 right-0 mt-2 mr-2">
                                            <button
                                                class="flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white focus:outline-none"
                                                wire:click="clearFilter('category', '{{ $category->id }}')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    @endif
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
        </div>
        <div class="flex flex-wrap px-6 py-10 bg-gray-100 bg-opacity-80">
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
                                <button type="button" wire:click="filterType('category', '{{ $category->id }}')">
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
            </div>

            <div class="hidden lg:block w-1/4 px-3">
                <div class="mb-6 p-4 bg-gray-50">
                    <h3 class="mb-8 text-2xl font-bold font-heading">{{ __('Price budget') }}</h3>

                    <div x-data="{ minPrice: {{ $minPrice }}, maxPrice: {{ $maxPrice }} }">
                        <div class="mb-6">
                            <input type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="1" x-model="minPrice" @input="$wire.minPrice = minPrice">
                            <input type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="1" x-model="maxPrice" @input="$wire.maxPrice = maxPrice">
                        </div>
                        <div class="text-sm text-center">
                            Price Range: <span x-text="minPrice"></span>DH - <span x-text="maxPrice"></span>DH
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-3/4 px-4" wire:loading.class.delay="opacity-50">
                <div itemscope itemtype="https://schema.org/ItemList">
                    <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 xs:grid-cols-2 mb-10">
                        @forelse ($products as $product)
                            <x-product-card :product="$product" />
                        @empty
                            <div class="col-span-full text-center mt-6">
                                <h3 class="text-3xl font-bold font-heading text-blue-900">
                                    {{ __('No products found') }}
                                </h3>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        @if (count($this->sections) > 0)
            <section class="py-5 px-10 mx-auto bg-gray-100">
                @foreach ($this->sections as $section)
                    <div class="px-3 relative h-full text-center py-16 bg-white">
                        <div class="pb-12 border-b">
                            <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                            @if ($section->subtitle)
                                <p>{{ $section->subtitle }}</p>
                            @endif
                        </div>
                        <div class="py-5 px-4 text-center">
                            <p class="text-lg text-gray-500">
                                {!! $section->description !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </section>
        @endif
    </div>
    @livewire('front.cart-count')
</div>
