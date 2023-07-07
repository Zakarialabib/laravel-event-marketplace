<div>
    @section('title', __('Catalog'))

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta property="og:title" content="{{ __('Catalog') }}">
        <meta property="og:url" content="{{ URL::current() }}">
    @endsection

    <div x-data="{ showSidebar: false }">
        <section class="relative table w-full bg-green-700 pt-16 pb-24">
            <div class="px-4">
                <div class="grid grid-cols-1 text-center mt-10">
                    <h3
                        class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                        {{ __('Catalog of products') }}
                    </h3>
                    <div class="absolute text-center z-10 bottom-5 start-0 end-0 mx-3">
                        <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-0 inline-block">
                            <li
                                class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-white pr-4">
                                <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white"
                                aria-current="page">
                                <a href="{{ URL::Current() }}">
                                    {{ __('Catalog of products') }}
                                </a>
                            </li>
                        </ul>
                        <div class="w-full sm:w-auto flex justify-center my-2 overflow-x-scroll">
                            <select
                                class="px-5 py-3 mr-2 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                                id="sortBy" wire:model.lazy="sorting">
                                <option disabled>{{ __('Choose filters') }}</option>
                                @foreach ($sortingOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <select
                                class="px-5 py-3 mr-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500"
                                id="perPage" wire:model="perPage">
                                <option value="20" selected>20 {{ __('Items') }}</option>
                                <option value="50">50 {{ __('Items') }}</option>
                                <option value="100">100 {{ __('Items') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end grid-->
            </div>
        </section>
        <div class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
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
            })" class="relative w-10/12 mx-auto flex flex-row">
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
                                <div class="relative inline-flex mb-3.5 md:mb-4 lg:mb-5 xl:mb-6 mx-auto rounded-full">
                                    <button type="button" wire:click="filterType('category', {{ $category->id }})">
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
                                                    style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"><noscript></noscript></span>
                                        </div>
                                        <div
                                            class="absolute top left bg-black w-full h-full opacity-0 transition-opacity duration-300 group-hover:opacity-30 rounded-full">
                                        </div>
                                        <div class="absolute top left h-full w-full flex items-center justify-center">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                viewBox="0 0 512 512"
                                                class="text-white text-base sm:text-xl lg:text-2xl xl:text-3xl transform opacity-0 scale-0 transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:scale-100"
                                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z">
                                                </path>
                                            </svg>
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
        </div>
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
                        @foreach (Helpers::getActiveCategories() as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('category', {{ $category->id }})">
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
            <div class="hidden lg:block w-1/4 py-6 px-2">
                <div class="mb-6 p-4 bg-gray-50" x-data="{ openCategory: true }">
                    <div class="flex justify-between mb-8">
                        <h3 class="text-xl font-bold font-heading">{{ __('Category') }}</h3>
                        <button @click="openCategory = !openCategory">
                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </button>
                    </div>
                    <ul x-show="openCategory">
                        @foreach (Helpers::getActiveCategories() as $category)
                            <li class="mb-2">
                                <button type="button" wire:click="filterType('category', {{ $category->id }})">
                                    <span class="inline-block px-4 py-2 text-sm font-bold font-heading text-blue-300">
                                        {{ $category->name }} <small>
                                        </small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if (!empty($category_id))
                        <div class="text-right">
                            <button wire:click="clearFilter('category')">{{ __('Clear') }}</button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="w-full lg:w-3/4 py-6 px-4" wire:loading.class.delay="opacity-50">
                <div itemscope itemtype="https://schema.org/ItemList">
                    <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 xs:grid-cols-2 mb-10">
                        @forelse ($products as $product)
                            <x-product-card :product="$product" />
                        @empty
                            <div class="col-span-full">
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
    </div>

</div>
