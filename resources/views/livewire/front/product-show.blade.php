<div>

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}" />
        <meta property="og:title" content="{{ $product->meta_title }}">
        <meta property="og:description" content="{!! $product->meta_description !!}">
        <meta property="og:url" content="{{ URL::current() }}">
        <meta property="og:image" content="{{ asset('images/products/' . $product->image) }}">
        <meta property="og:image:secure_url" content="{{ asset('images/products/' . $product->image) }}">
        <meta property="og:image:width" content="1000">
        <meta property="og:image:height" content="1000">
        {{-- <meta property="product:brand" content="{{ $product->brand?->name }}"> --}}
        <meta property="product:availability" content="in stock">
        <meta property="product:condition" content="new">
        <meta property="product:price:amount" content="{{ $product->price }}">
        <meta property="product:price:currency" content="MAD">
    @endsection

    <section class="relative table w-full pt-16 py-24">
        <div itemtype="https://schema.org/Product" itemscope>

            <meta itemprop="name" content="{{ $product->name }}" />
            <meta itemprop="description" content="{!! $product->description !!}" />

            <div class="mx-auto px-6 my-10">
                <div class="flex flex-wrap mb-14">
                    <div class="w-full md:w-1/2 px-4 mb-8 mt-10 md:mb-0">
                        <x-product-carousel :product="$product" />
                    </div>

                    <div class="w-full md:w-1/2 px-4">
                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <div class="mb-5 pb-5 border-b">
                                <span class="text-gray-500">
                                    {{ $product->category?->name }} /
                                    {{-- @isset($product->brand)
                                        <a href="{{ route('front.brandPage', $product->brand?->slug) }}">{{ $product->brand?->name }}</a>
                                    @endisset
                                    <div itemprop="brand" itemtype="https://schema.org/Brand" itemscope>
                                        <meta itemprop="brand" content="{{ $product->brand?->name }}" />
                                    </div> --}}
                                </span>
                                <h2 class="mt-2 mb-6 max-w-xl lg:text-5xl sm:text-xl font-bold font-heading">
                                    {{ $product->name }}
                                </h2>

                            </div>

                            @if ($product->options)
                                <div class="mb-2">
                                    <h4 class="text-base md:text-lg text-heading font-semibold mb-2.5 capitalize">
                                        {{ __('Size') }}
                                    </h4>
                                    <ul class="flex flex-wrap">
                                        @foreach (json_decode($product->options, true) as $option)
                                            @if ($option['type'] === 'size')
                                                <li
                                                    class="cursor-pointer rounded border  w-11 h-11 p-2 mb-2 md:mb-3 mr-2 md:mr-3 -3 flex justify-center items-center text-heading text-xs md:text-sm uppercase font-semibold transition duration-200 ease-in-out hover:border-gray-600 border-black">
                                                    <button class="block w-full h-full rounded"
                                                        wire:click="$set('selectedSize', '{{ $option['value'] }}')">
                                                        {{ $option['value'] }}
                                                    </button>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="mb-2">
                                    <h4 class="text-base md:text-lg text-heading font-semibold mb-2.5 capitalize">
                                        {{ __('Color') }}
                                    </h4>
                                    <ul class="flex flex-wrap">
                                        @foreach (json_decode($product->options, true) as $option)
                                            @if ($option['type'] === 'color')
                                                <li
                                                    class="cursor-pointer rounded border  w-9 md:w-11 h-9 md:h-11 p-1 mb-2 md:mb-3 mr-2 md:mr-3 flex justify-center items-center text-heading text-xs md:text-sm uppercase font-semibold transition duration-200 ease-in-out hover:border-gray-600 border-black">
                                                    <button class="block w-full h-full rounded"
                                                        wire:click="$set('selectedColor', '{{ $option['value'] }}')"
                                                        style="background-color: {{ $option['value'] }};"></button>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="w-full flex items-center justify-center gap-6 pb-5 border-b">
                                <div itemprop="offers" itemtype="https://schema.org/AggregateOffer" itemscope>
                                    <p class="inline-block text-2xl font-bold font-heading">
                                        <span>
                                            {{ Helpers::format_currency($product->price) }}
                                        </span>
                                        @if ($product->discount_price && $product->discount != 0)
                                            <span class="bg-red-500 text-white rounded-xl px-4 py-2 text-sm ml-4">
                                                -{{ $product->discount }}%
                                            </span>
                                        @endif

                                        <meta itemprop="lowPrice" content="{{ $product->odl_price }}">
                                        <meta itemprop="highPrice" content="{{ $product->price }}">
                                        <meta itemprop="price" content="{{ $product->price }}">
                                        <meta itemprop="priceCurrency" content="MAD">
                                        <link itemprop="availability" href="http://schema.org/InStock">
                                        <link itemprop="itemCondition" href="http://schema.org/NewCondition">
                                        <meta itemprop="priceValidUntil" content="2023-12-30">

                                    </p>

                                    @if ($product->discount_price && $product->discount != 0)
                                        <p class="mb-8 text-blue-300">
                                            <span class="font-normal text-base text-gray-400 line-through">
                                                {{ Helpers::format_currency($product->discount_price) }}DH
                                            </span>
                                        </p>
                                    @endif
                                </div>
                                <div>
                                    <div
                                        class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                        <button wire:click="decreaseQuantity('{{ $product->id }}')"
                                            class="py-2 hover:text-gray-700">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4 10a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z"
                                                    clip-rule="evenodd">
                                                </path>
                                            </svg>
                                        </button>
                                        <input
                                            class="w-10 m-0 px-2 py-2 text-center md:text-right border-0 focus:ring-transparent focus:outline-none rounded-md"
                                            value="{{ $quantity }}" wire:model="quantity">
                                        <button wire:click="increaseQuantity('{{ $product->id }}')"
                                            class="py-2 hover:text-gray-700">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V6a1 1 0 011-1z"
                                                    clip-rule="evenodd">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    @if ($product->status === \App\Enums\Status::ACTIVE)
                                        <a class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-green-400 hover:bg-green-200 transition cursor-pointer"
                                            wire:click="AddToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                                            {{ __('Add to cart') }}
                                        </a>
                                    @else
                                        <div class="text-sm font-bold">
                                            <span class="text-red-500">● {{ __('Not available') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <livewire:front.order-form :item="$product" type="product" />

                            <ul class="w-full flex flex-wrap justify-between my-4 ">
                                <li class="text-gray-500 py-1">
                                    <i class="text-blue-600 fa fa-check" aria-hidden="true"></i>
                                    {{ __('Fast delivery') }}
                                </li>
                                <li class="text-gray-500 py-1">
                                    <i class="text-blue-600 fa fa-check" aria-hidden="true"></i>
                                    {{ __('Free return') }}
                                </li>
                                <li class="text-gray-500 py-1">
                                    <i class="text-blue-600 fa fa-check" aria-hidden="true"></i>
                                    {{ __('Free shipping') }}
                                </li>
                            </ul>

                            <div class="flex items-center">
                                <span
                                    class="mr-8 text-gray-500 font-bold font-heading uppercase">{{ __('SHARE IT') }}</span>
                                <a class="mr-1 w-8 h-8" href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="mr-1 w-8 h-8" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="w-8 h-8" href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="w-8 h-8" href="#">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-data="{ activeTab: 'description' }" class="mx-auto px-4 border bg-white shadow-xl">
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-10">
                        <div
                            class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                            <button @click="activeTab = 'description'"
                                :class="activeTab === 'description' ? 'text-green-400' : ''">
                                {{ __('Description') }}
                            </button>
                        </div>
                        <div
                            class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                            <button @click="activeTab = 'shipping'"
                                :class="activeTab === 'shipping' ? 'text-green-400' : ''">
                                {{ __('Shipping & Returns') }}
                            </button>
                        </div>
                        <div
                            class="inline-block py-6 px-10 text-left font-bold font-heading text-gray-500 uppercase border-b-2 border-gray-100 hover:border-gray-500 focus:outline-none focus:border-gray-500">
                            <button @click="activeTab = 'brands'"
                                :class="activeTab === 'brands' ? 'text-green-400' : ''">
                                {{ __('Product Brand') }}
                            </button>
                        </div>
                    </div>
                    <div x-show="activeTab === 'description'" class="px-5 mb-10">
                        <div role="description" aria-labelledby="tab-0" id="tab-panel-0" tabindex="0">
                            <p class="mb-8 max-w-2xl text-gray-500 font-body">
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                    <div x-show="activeTab === 'shipping'" class="px-5 mb-10">
                        <div role="shipping" aria-labelledby="tab-2" id="tab-panel-2" tabindex="0">
                            <p class="mb-8 max-w-2xl text-gray-500 font-body">
                                {{-- {!! $product->shipping !!} --}}
                            </p>
                        </div>
                    </div>
                    <div x-show="activeTab === 'brands'" class="px-5 mb-10">
                        <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 -mx-2 px-2">
                            @foreach ($brand_products as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto px-6">
                <h4 class="mb-2 text-xl font-bold font-heading">
                    {{ __('Related Products') }}
                </h4>
                <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 -mx-2 px-2">
                    @foreach ($relatedProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @livewire('front.cart-count')
</div>
