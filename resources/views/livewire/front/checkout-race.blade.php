<div>
    @section('title', __('Order Confirmation'))
    <section class="py-5 mx-auto pt-16 px-10 bg-gray-100">
        <h2 class="my-6 text-center text-5xl font-bold font-heading">{{ __('Order Confirmation') }}</h2>
        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 px-4 pt-5 bg-white">

                @livewire('account.user-infos', ['user' => $user])

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
                            <p>{{ __('Phone number') }}: {{ $this->participant->phone_number }}</p>
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
                            <p>{{ __('Zip code') }}: {{ $this->participant->zip_code }}</p>
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
                            <p>{{ __('Emergency contact name') }}:
                                {{ $this->participant->emergency_contact_name }}</p>
                            <p>{{ __('Emergency contact phone number') }}:
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
                <div class="pb-10 pt-5 px-6 md:px-14 bg-white">
                    <div class="flex mb-5 items-center">
                        <h2 class="text-4xl font-bold font-heading">{{ __('Summary') }}</h2>
                    </div>

                    <!-- Races Cart Items -->
                    <div class="mb-2 flex flex-wrap items-center">
                        <h3 class="text-2xl font-bold font-heading mb-4">{{ __('Races') }}</h3>
                        @foreach ($this->registrationCartItems as $item)
                            <div class="flex flex-wrap w-full mb-10 items-center">
                                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                                    <div class="flex h-32 items-center justify-center bg-gray-100">
                                        <a href="{{ route('front.raceDetails', $item->model->slug) }}"
                                            target="_blank" class="h-full">
                                            <img class="h-full object-cover"
                                                src="{{ $item->model->getFirstMediaUrl('local_files') }}"
                                                alt="{{ $item->name }}">
                                        </a>
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
                                                            {{ formatCurrency($item->price) }}
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
                    <!-- Services Cart Items -->
                    <div class="mb-2 flex flex-wrap items-center">
                        <h3 class="text-2xl font-bold font-heading mb-4">{{ __('Services') }}</h3>
                        <div class="flex flex-wrap w-full mb-10">
                            @foreach ($this->servicesCartItems as $item)
                                <div class="w-full md:w-1/2 px-4">
                                    <div>
                                        @if (!empty($item->name))
                                            <h3 class="mb-3 text-left">
                                                {{ $item->name }}
                                            </h3>
                                        @endif
                                        <div class="flex flex-wrap items-center justify-between">
                                            <div
                                                class="inline-flex items-center px-4 font-semibold font-heading text-gray-500 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                                <div class="flex items-center space-x-2">
                                                    @if (!empty($item->price))
                                                        <p class="text-lg text-green-500 font-bold font-heading">
                                                            {{ formatCurrency($item->price) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mb-2"></div>

                    <div class="my-5">
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

                    <div class="border-t border-gray-200 mb-2"></div>

                    <!-- Subtotals and Total -->
                    <div class="mb-2">
                        <div class="flex flex-col gap-4 mb-5">
                            <!-- Races Subtotal -->
                            <div class="py-3 px-10 bg-blue-50 rounded-full">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ __('Registration Subtotal') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ formatCurrency($this->registration_subtotal) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Services Subtotal -->
                            <div class="py-3 px-10 bg-blue-50 rounded-full">
                                <div class="flex justify-between">
                                    <span class="font-medium">{{ __('Services Subtotal') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ formatCurrency($this->services_subtotal) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="py-3 px-10 bg-blue-200 rounded-full">
                                <div class="flex justify-between">
                                    <span
                                        class="text-base md:text-xl font-bold font-heading">{{ __('Total') }}</span>
                                    <span class="font-bold font-heading">
                                        {{ formatCurrency($this->registration_subtotal + $this->services_subtotal) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" wire:loading.attr="disabled" wire:click="checkout"
                        class="block w-full py-4 bg-red-500 hover:bg-red-700 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200">
                        <span>
                            <div wire:loading wire:target="checkout">
                                <x-loading />
                            </div>
                            <span>{{ __('Confirm Order') }}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="px-3">
            <div class="flex flex-row gap-4 justify-between px-6 py-4 mt-4 bg-white rounded-3 shadow-sm">
                <div class="inline-flex">
                    <i class="fa fa-headset text-xl"></i>
                    <div class="ps-3">
                        <h6 class="text-base mb-1">Service client</h6>
                        <p class="mb-0 text-sm text-muted">Support client amical pour nos clients</p>
                    </div>
                </div>
                <div class="inline-flex">
                    <i class="fa fa-lock text-xl"></i>
                    <div class="ps-3">
                        <h6 class="text-base mb-1">Paiement en ligne sécurisé avec CMI</h6>
                        <p class="mb-0 text-sm text-muted">Nous possédons un certificat SSL / Secure et utilisons
                            la
                            passerelle CMI pour une grande sécurité</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
