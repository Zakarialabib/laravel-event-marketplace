<div>
    <section class="py-5 mx-auto pt-16 px-10 bg-gray-100">
        <h2 class="my-6 text-center text-5xl font-bold font-heading">{{ __('Checkout') }}</h2>
        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 px-4">
                <form wire:submit.prevent="checkout">
                    <div class="flex my-5 items-center">
                        <h2 class="text-4xl font-bold font-heading">{{ __('Billing details') }}</h2>
                    </div>
                    
                </form>
            </div>
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
                                            @if (!empty($item->model->image))
                                                <img class="h-full object-contain"
                                                    src="{{ $race->model->getFirstMediaUrl('local_files') }}"
                                                    alt="{{ $item->name }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-full md:w-2/3 px-4">
                                        <div>
                                            @if (!empty($item->name))
                                                <h3 class="mb-3 text-xl font-bold font-heading text-gray-900">
                                                    {{ $item->name }}
                                                </h3>
                                            @endif
                                            <div class="flex flex-wrap items-center justify-between">
                                                <div
                                                    class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                                    <div class="flex items-center space-x-2">
                                                        @if (!empty($item->price))
                                                            <p
                                                                class="text-lg bg-green-500 text-white font-bold font-heading">
                                                                {{ Helpers::format_currency($item->price) }}
                                                            </p>
                                                        @endif
                                                        @if (!empty($item->rowId))
                                                            <button wire:click="removeFromCart('{{ $item->rowId }}')"
                                                                class="text-red-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                                                <i class="fa fa-trash-alt"></i>
                                                            </button>
                                                        @endif
                                                    </div>

                                                </div>
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
                    <button
                        class="block w-full py-4 bg-red-500 hover:bg-red-700 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200"
                        type="button" wire:click="checkout">
                        {{ __('Confirm Order') }}
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
