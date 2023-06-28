<div>
    @section('title', __('Catalog'))

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta property="og:title"
            content="{{__('Catalog')}}">
        <meta property="og:url" content="{{ URL::current() }}">
    @endsection

    <div x-data="{ showSidebar: false }">
        <section class="relative table w-full bg-redBrick-700 pt-16 pb-24">
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
                        @foreach ($this->categories as $category)
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
                            <div class="w-full">
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
