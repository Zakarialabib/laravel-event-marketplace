<div>
    @section('title', __('Order Confirmation'))
    <section class="py-5 mx-auto pt-16 px-10 bg-gray-100">
        <h2 class="my-6 text-center text-5xl font-bold font-heading">{{ __('Order Confirmation') }}</h2>
        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 px-4">
                <div class="flex my-5 items-center">
                    <h2 class="text-4xl font-bold font-heading">{{ __('Participant Details') }}</h2>
                </div>
                <div x-data="{ openSection: 1 }">
                    <!-- Personal Information -->
                    <div class="mt-2">
                        <button type="button"
                            class="accordion px-4 w-full py-2 bg-gray-200 flex justify-between items-center"
                            @click="openSection !== 1 ? openSection = 1 : openSection = null">
                            {{ __('Personal Information') }}
                            <svg x-show="openSection !== 1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <svg x-show="openSection === 1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform rotate-180 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                </path>
                            </svg>
                        </button>

                        <div class="bg-white px-4 py-2 text-center" x-show="openSection === 1">
                            <p>{{ __('Name') }}: {{ $this->participant->name }}</p>
                            <p>{{ __('Email') }}: {{ $this->participant->email }}</p>
                            <p>{{ __('Phone Number') }}: {{ $this->participant->phone_number }}</p>
                            <p>{{ __('Birth Date') }}: {{ $this->participant->birth_date }}</p>
                            <p>{{ __('Gender') }}: {{ $this->participant->gender }}</p>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="mt-2">
                        <button type="button"
                            class="accordion px-4 w-full py-2 bg-gray-200 flex justify-between items-center"
                            @click="openSection !== 2 ? openSection = 2 : openSection = null">
                            {{ __('Address') }}
                            <svg x-show="openSection !== 2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <svg x-show="openSection === 2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform rotate-180 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                </path>
                            </svg>
                        </button>
                        <div class="bg-white px-4 py-2 text-center" x-show="openSection === 2">
                            <p>{{ __('Country') }}: {{ $this->participant->country }}</p>
                            <p>{{ __('City') }}: {{ $this->participant->city }}</p>
                            <p>{{ __('ZIP Code') }}: {{ $this->participant->zip_code }}</p>
                            <p>{{ __('Address') }}: {{ $this->participant->address }}</p>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="mt-2">
                        <button type="button"
                            class="accordion px-4 w-full py-2 bg-gray-200 flex justify-between items-center"
                            @click="openSection !== 3 ? openSection = 3 : openSection = null">
                            {{ __('Emergency Contact') }}
                            <svg x-show="openSection !== 3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <svg x-show="openSection === 3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform rotate-180 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                </path>
                            </svg>
                        </button>
                        <div class="bg-white px-4 py-2 text-center" x-show="openSection === 3">
                            <p>{{ __('Emergency Contact Name') }}:
                                {{ $this->participant->emergency_contact_name }}</p>
                            <p>{{ __('Emergency Contact Phone Number') }}:
                                {{ $this->participant->emergency_contact_phone_number }}</p>
                        </div>
                    </div>

                    <!-- Medical Information -->
                    <div class="mt-2">
                        <button type="button"
                            class="accordion px-4 w-full py-2 bg-gray-200 flex justify-between items-center"
                            @click="openSection !== 4 ? openSection = 4 : openSection = null">
                            {{ __('Medical Information') }}
                            <svg x-show="openSection !== 4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <svg x-show="openSection === 4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                class="w-6 h-6 transform rotate-180 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 15l7-7 7 7"></path>
                            </svg>
                        </button>
                        <div class="bg-white px-4 py-2 text-center" x-show="openSection === 4">
                            <p>{{ __('Health Informations') }}: {{ $this->participant->health_informations }}</p>
                            <p>{{ __('Medical History') }}: {{ $this->participant->medical_history }}</p>
                            <p>{{ __('Taking Medications') }}: {{ $this->participant->taking_medications }}</p>
                            <p>{{ __('Medication Allergies') }}: {{ $this->participant->medication_allergies }}
                            </p>
                            <p>{{ __('Sensitivities') }}: {{ $this->participant->sensitivities }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 px-4">
                <div class="py-16 px-6 md:px-14 bg-white">
                    <div class="flex mb-5 items-center">
                        <h2 class="text-4xl font-bold font-heading">{{ __('Summary') }}</h2>
                    </div>

                    <div class="mb-2 flex flex-wrap -mx-4 items-center">
                        @foreach ($this->cartItems as $item)
                            <div class="flex flex-wrap w-full mb-10">
                                <div class="w-full md:w-1/3 mb-6 md:mb-0 px-4">
                                    <div class="flex h-32 items-center justify-center bg-gray-100">
                                        @if (!empty($item->model->image))
                                            <a href="{{ route('front.raceDetails', $item->model->slug) }}"
                                                target="_blank">

                                                <img class="h-full object-contain"
                                                    src="{{ $race->model->getFirstMediaUrl('local_files') }}"
                                                    alt="{{ $item->name }}">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full md:w-2/3 px-4">
                                    <div>
                                        @if (!empty($item->name))
                                            <h3 class="mb-3 text-left">
                                                <a href="{{ route('front.raceDetails', $item->model->slug) }}"
                                                    target="_blank" class="cursor-pointer">
                                                    {{ $item->name }}
                                                </a>
                                            </h3>
                                        @endif
                                        <div class="flex flex-wrap items-center justify-between">
                                            <div
                                                class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                                <div class="flex items-center space-x-2">
                                                    @if (!empty($item->price))
                                                        <p class="text-lg text-green-500 font-bold font-heading">
                                                            {{ Helpers::format_currency($item->price) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 mb-2"></div>

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
                    
                    <div class="mb-2">
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
