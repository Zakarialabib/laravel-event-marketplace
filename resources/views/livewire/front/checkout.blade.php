<div>
    @section('title', __('Checkout'))
    <section class="py-5 mx-auto pt-16 px-10 bg-gray-100">
        <h2 class="my-6 text-center text-5xl font-bold font-heading">{{ __('Order confirmation') }}</h2>
        <div class="flex flex-wrap">
            @guest
                <div class="w-full lg:w-1/2 bg-white pt-10 px-6">
                    @livewire('auth.login')
                </div>
            @endguest
            @auth
                <div class="w-full lg:w-1/2 px-4">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="mb-4 text-xl font-semibold text-gray-700">
                            {{ __('Shipping & Payment Details') }}
                        </h3>
                        <form wire:submit.prevent="checkout">
                            <div class="mb-4">
                                <label for="shipping" class="font-bold text-gray-800">{{ __('Shipping Method') }}:</label>
                                <select id="shipping" wire:model="shipping_id" class="form-input mt-1 block w-full">
                                    <option value="">{{ __('Please select') }}</option>
                                    @foreach ($this->shippings as $shipping)
                                        <option value="{{ $shipping->id }}">
                                            {{ $shipping->title }} - {{ Helpers::format_currency($shipping->cost) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400"
                                    for="payment_method">{{ __('Payment Method') }}</label>
                                <select wire:model="payment_method"
                                    class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                                    required>
                                    <option value="card">{{ __('Card') }}</option>
                                    <!-- Add more options as needed -->
                                </select>
                                @error('payment_method')
                                    <span class="error text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            @endauth
            <div class="w-full lg:w-1/2 px-4">
                <div class="py-16 px-6 md:px-14 bg-white">
                    <div class="flex mb-5 items-center">
                        <h2 class="text-4xl font-bold font-heading">{{ __('Order summary') }}</h2>
                    </div>
                    <div class="mb-5 border-b">
                        <div class="flex flex-wrap -mx-4 mb-5 items-center">
                            @foreach ($this->cartItems as $item)
                                <div class="flex flex-wrap w-full mb-10">
                                    <div class="w-full md:w-1/3 mb-6 md:mb-0 px-4">
                                        <div class="flex h-32 items-center justify-center bg-gray-100">
                                            <img class="h-full object-contain"
                                                src="{{ $item->model->getFirstMediaUrl('local_files') }}"
                                                alt="{{ $item->name }}">
                                        </div>
                                    </div>
                                    <div class="w-full md:w-2/3 px-4">
                                        <div>
                                            @if (!empty($item->name))
                                                <h3 class="mb-3 text-xl font-bold font-heading text-gray-900">
                                                    {{ $item->name }}
                                                </h3>
                                            @endif

                                            @if (!empty($item->options))
                                                <p>
                                                    {{ $item->options->has('size') ? $item->options->size : '' }}
                                                </p>
                                            @endif
                                            @if (!empty($item->price))
                                                <p
                                                    class="text-lg text-center mb-4 text-green-500 font-bold font-heading">
                                                    {{ Helpers::format_currency($item->price) }}
                                                </p>
                                            @endif
                                            <div class="flex flex-wrap items-center justify-center gap-2">
                                                @if (!empty($item->rowId))
                                                    <button wire:click="decreaseQuantity('{{ $item->rowId }}')"
                                                        class="text-gray-600 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M4 10a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z"
                                                                clip-rule="evenodd">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                @endif
                                                @if (!empty($item->qty))
                                                    <span class="text-gray-700 mx-2">{{ $item->qty }}</span>
                                                @endif
                                                @if (!empty($item->rowId))
                                                    <button wire:click="increaseQuantity('{{ $item->rowId }}')"
                                                        class="text-gray-600 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 5a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V6a1 1 0 011-1z"
                                                                clip-rule="evenodd">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                    <button wire:click="removeFromCart('{{ $item->rowId }}')"
                                                        class="text-red-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="mb-5">
                            <div class="py-3 px-10 bg-blue-50 rounded-full">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ __('Subtotal') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ Helpers::format_currency($this->subTotal) }}
                                    </span>
                                </div>
                            </div>
                            <div class="py-3 px-10 rounded-full">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ __('Shipping') }}</span>
                                    @if (!empty($this->shipping_id))
                                        <span class="font-bold font-heading">
                                            {{ Helpers::format_currency($this->shipping->cost) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="py-3 px-10 rounded-full">
                                <div class="flex justify-between">
                                    <span
                                        class="text-base md:text-xl font-bold font-heading">{{ __('Total') }}</span>
                                    @if (!empty($this->cartTotal))
                                        <span class="font-bold font-heading">
                                            {{ Helpers::format_currency($this->cartTotal) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth
                        <button
                            class="block w-full py-4 bg-red-500 hover:bg-red-700 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200"
                            type="button" wire:click="checkout">
                            {{ __('Confirm Order') }}
                        </button>
                    @endauth
                </div>
            </div>

        </div>
        <div class="px-3">
            <div class="flex flex-row gap-4 justify-between px-6 py-4 mt-4 bg-white rounded-3 shadow-sm">
                <!-- First Section -->
                <div class="inline-flex">
                    <!-- Font Awesome icon for delivery -->
                    <i class="fa fa-shipping-fast text-xl"></i>
                    <div class="ps-3">
                        <h6 class="fs-base mb-1">Livraison rapide et gratuite à casablanca</h6>
                        <p class="mb-0 fs-ms text-muted">Livraison gratuite si vous habitez à casablanca</p>
                    </div>
                </div>
                <!-- Second Section -->
                <div class="inline-flex">
                    <!-- Font Awesome icon for money-back guarantee -->
                    <i class="fa fa-money-check-alt text-xl"></i>
                    <div class="ps-3">
                        <h6 class="text-base mb-1">Garantie de remboursement</h6>
                        <p class="mb-0 text-sm text-muted">Nous retournons l'argent dans les 30 jours</p>
                    </div>
                </div>
                <!-- Third Section -->
                <div class="inline-flex">
                    <!-- Font Awesome icon for customer service -->
                    <i class="fa fa-headset text-xl"></i>
                    <div class="ps-3">
                        <h6 class="text-base mb-1">Service client</h6>
                        <p class="mb-0 text-sm text-muted">Support client amical pour nos clients</p>
                    </div>
                </div>
                <!-- Fourth Section -->
                <div class="inline-flex">
                    <!-- Font Awesome icon for secure payment -->
                    <i class="fa fa-lock text-xl"></i>
                    <div class="ps-3">
                        <h6 class="text-base mb-1">Paiement en ligne sécurisé avec CMI</h6>
                        <p class="mb-0 text-sm text-muted">Nous possédons un certificat SSL / Secure et utilisons la
                            passerelle CMI pour une grande sécurité</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewire('front.cart-count')
</div>
