<div>
    @section('title', __('Registration for') . ' - ' . $race->name)

    <section class="relative w-full pt-36 pb-10 h-auto bg-black bg-opacity-60 border-b shadow-md border-green-700">
        <div class="grid grid-cols-1 text-center mt-10 bottom-0 px-4">
            <div class="text-center z-10 my-2">
                <h3
                    class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                    {{ $race->name }}
                </h3>

            </div>
        </div>
        <form wire:submit.prevent="register" class="mb-6 mx-10 drop-shadow-lg bg-white">
            <h3
                class="w-full text-center mb-4 pt-10 pb-5 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                {{ __('Registration') }}
            </h3>

            @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('races')->count() > 0)
                <p class="py-5">
                    <x-button primary href="{{ route('front.checkout-race') }}">
                        {{ __('Continue to checkout') }}
                    </x-button>
                </p>
            @endif

            <div x-data="{
                step: 1,
                registrationType: 'individual',
                nextStep() { this.step++ },
                previousStep() { if (this.step > 1) this.step-- }
            }" class="border rounded p-4 shadow-lg w-full text-center mb-4">

                <!-- Progress Bar -->
                <div class="mb-4 px-6">
                    <div class="h-2 rounded bg-gray-200">
                        <div class="h-2 bg-blue-500" x-bind:style="`width: ${(step / 3) * 100}%`"></div>
                    </div>
                </div>

                <!-- Current Step Indicator -->
                <div class="mb-4 px-6 text-lg font-bold">
                    {{ __('Step') }}: <span x-text="step"></span>/3
                </div>

                <p class="mb-4 px-6">
                    Time Remaining: <span id="timeRemaining">{{ gmdate('i:s', $timeRemaining) }}</span>
                </p>
                <p class="py-5">
                    {{ __('You may lose your registration spot if your browser session is idle for more than 15 minutes. ') }}
                </p>

                <div class="inline-block relative justify-center py-4 w-full">
                    <label for="isTeamRegistration" class="flex justify-center items-center cursor-pointer">
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                type="checkbox" id="isTeamRegistration" name="isTeamRegistration"
                                x-on:change="registrationType = $event.target.checked ? 'team' : 'individual';" />
                            <label for="isTeamRegistration"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>
                        <div class="ml-3 text-gray-700 font-medium text-md">
                            {{ __('Register as a team') }}
                        </div>
                    </label>
                </div>


                <x-validation-errors class="mb-4" :errors="$errors" />

                <div x-show="registrationType === 'team'">
                    @livewire('front.team-form')
                </div>

                <div x-show="registrationType === 'individual' || registrationType === 'team'" class="w-full">
                    <div class="grid xl:md:grid-cols-2 sm:grid-cols-1 gap-4 items-center" x-show="step === 1">
                        <label class="col-span-full block mb-2 font-bold font-heading text-gray-700">
                            {{ __('Participant Information') }}
                        </label>
                        <div>
                            <x-label required for="email" :value="__('Email')" />
                            <x-input wire:model="participant.email" required id="email" name="email"
                                type="email" autocomplete="email" />
                            <x-input-error :messages="$errors->get('participant.email')" for="participant.email" class="mt-2" />
                        </div>
                        <div>
                            <x-label required for="name" :value="__('Full name')" />
                            <x-input wire:model="participant.name" required type="text" id="name" name="name"
                                required autocomplete="name" />
                            <x-input-error :messages="$errors->get('participant.name')" for="participant.name" class="mt-2" />
                        </div>

                        <div>
                            <x-label required for="phone_number" :value="__('Phone number')" />
                            <x-input wire:model="participant.phone_number" required type="tel" id="phone_number"
                                name="phone_number" autocomplete="phone_number" />
                            <x-input-error :messages="$errors->get('participant.phone_number')" for="participant.phone_number" class="mt-2" />
                        </div>
                        <div>
                            <x-label required for="country" :value="__('Country')" />
                            <x-country-select wire:model="participant.country" id="country" required />
                            <x-input-error :messages="$errors->get('participant.country')" for="participant.country" class="mt-2" />
                        </div>
                        <div>
                            <x-label required for="city" :value="__('City')" />
                            <x-input wire:model="participant.city" required type="text" id="city"
                                name="city" />
                            <x-input-error :messages="$errors->get('participant.city')" for="participant.city" class="mt-2" />
                        </div>
                        <div>
                            <x-label for="zip_code" :value="__('Zip code')" />
                            <x-input wire:model="participant.zip_code" type="text" id="zip_code" name="zip_code" />
                            <x-input-error :messages="$errors->get('participant.zip_code')" for="participant.zip_code" class="mt-2" />
                        </div>
                        <div>
                            <x-label for="birth_date" :value="__('date of birth')" required />
                            <x-date-picker id="birth_date" picker="date" required name="date"
                                wire:model="participant.birth_date" />
                            <x-input-error :messages="$errors->get('participant.birth_date')" for="participant.birth_date" class="mt-2" />
                        </div>
                        <div>
                            <x-label required :value="__('Gender')" for="gender" />
                            <select wire:model="participant.gender" id="gender" required
                                class="block w-full py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                                <option value="" selected disabled>{{ __('Select options') }}</option>
                                <option value="Men">{{ __('Men') }}</option>
                                <option value="Women">{{ __('Women') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('participant.gender')" for="participant.gender" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="emergency_contact_name" :value="__('Emergency contact name')" />
                            <x-input wire:model="participant.emergency_contact_name" name="emergency_contact_name"
                                type="text" />
                            <x-input-error :messages="$errors->get('participant.emergency_contact_name')" for="participant.emergency_contact_name"
                                class="mt-2" />
                        </div>

                        <div>
                            <x-label for="emergency_contact_phone_number" :value="__('Emergency contact phone number')" />
                            <x-input wire:model="participant.emergency_contact_phone_number"
                                name="emergency_contact_phone_number" type="tel" />
                            <x-input-error :messages="$errors->get('participant.emergency_contact_phone_number')" for="participant.emergency_contact_phone_number"
                                class="mt-2" />
                        </div>
                        <div class="col-span-full">
                            <x-label required for="address" :value="__('Address')" />
                            <x-input wire:model="participant.address" type="text" required id="address"
                                name="address" />
                            <x-input-error :messages="$errors->get('participant.address')" for="participant.address" class="mt-2" />
                        </div>
                        <div class="col-span-full flex justify-between mt-4">
                            <x-button secondary x-on:click="previousStep()" type="button">
                                {{ __('Go Back') }}
                            </x-button>
                            <x-button primary x-on:click="nextStep()" type="button">
                                {{ __('continue') }}
                            </x-button>
                        </div>
                    </div>

                    <div class="w-full" x-show="step === 2">
                        <label
                            class="block mb-2 font-bold font-heading text-gray-700">{{ __('Please specify any medical conditions') }}</label>

                        <x-checkbox-input label="{{ __('Health Informations') }}"
                            model="{{ $race->health_informations }}">
                            <x-input wire:model="participant.health_informations" type="text"
                                id="health_informations" class="w-full block" name="health_informations" />
                        </x-checkbox-input>

                        <x-checkbox-input label="{{ __('has Medical History') }}"
                            model="{{ $race->medical_history }}">
                            <x-input wire:model="participant.medical_history" type="text" id="medical_history"
                                class="w-full block" name="medical_history" />
                        </x-checkbox-input>

                        <x-checkbox-input label="{{ __('Taking Medications') }}"
                            model="{{ $race->taking_medications }}">
                            <x-input wire:model="participant.taking_medications" type="text"
                                id="taking_medications" class="w-full block" name="taking_medications" />
                        </x-checkbox-input>

                        <x-checkbox-input label="{{ __('has Medication Allergies') }}"
                            model="{{ $race->medication_allergies }}">
                            <x-input wire:model="participant.medication_allergies" type="text"
                                id="medication_allergies" class="w-full block" name="medication_allergies" />
                        </x-checkbox-input>

                        <x-checkbox-input label="{{ __('has Sensitivities') }}" model="{{ $race->sensitivities }}">
                            <x-input wire:model="participant.sensitivities" type="text" id="sensitivities"
                                class="w-full block" name="sensitivities" />
                        </x-checkbox-input>
                        <div class="flex justify-between mt-4">
                            <x-button secondary x-on:click="previousStep()" type="button">
                                {{ __('Go Back') }}
                            </x-button>
                            <x-button primary x-on:click="nextStep()" type="button">
                                {{ __('Continue') }}
                            </x-button>
                        </div>
                    </div>

                    <div x-show="step === 3" class="w-full py-10">
                        <label
                            class="block my-2 font-bold font-heading text-gray-700">{{ __('Additional Services') }}</label>

                        <ul class="space-y-2">
                            @foreach ($services as $service)
                                <li class="flex items-center">
                                    <label for="service-{{ $service->id }}" class="flex items-center">
                                        <input type="checkbox" wire:model="selectedServices" name="services[]"
                                            id="service-{{ $service->id }}" value="{{ $service->id }}"
                                            class="mr-2">
                                        {{ $service->name }} ({{ formatCurrency($service->price) }})
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                        <div class="w-full py-2">

                            <div class="flex items-center text-center gap-4 py-2 mb-2">
                                <x-label for="newsletters" :value="__('Register into promotional email')" />
                                <x-input.checkbox wire:model="newsletters" type="checkbox" />
                            </div>

                            <div class="flex items-center text-center gap-4 py-2 mb-2">
                                <x-label for="" :value="__('I accept the organiser and registration provider terms and conditions')" />
                                <x-input.checkbox wire:model="" type="checkbox" />
                            </div>

                            <div class="flex justify-between my-4">
                                <x-button secondary x-on:click="previousStep()" type="button">
                                    {{ __('Go Back') }}
                                </x-button>

                                @if (Auth::check())
                                    <x-button type="button" wire:loading.attr="disabled" wire:click="register"
                                        primary>
                                        <span>
                                            <div wire:loading wire:target="register">
                                                <x-loading />
                                            </div>
                                            <span>{{ __('Update') }}</span>
                                        </span>
                                    </x-button>
                                @else
                                    <button type="button" wire:loading.attr="disabled" wire:click="register"
                                        class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-green-600 hover:bg-green-200 transition cursor-pointer">
                                        <span>
                                            <div wire:loading wire:target="register">
                                                <x-loading />
                                            </div>
                                            <span>{{ __('Registration') }}</span>
                                        </span>
                                    </button>
                                @endif
                            </div>

                            <small>{{ __('We will send details about your registration your email with account access') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                setInterval(function() {
                    let timeElement = document.getElementById('timeRemaining');
                    let timeParts = timeElement.innerText.split(':');
                    let minutes = parseInt(timeParts[0]);
                    let seconds = parseInt(timeParts[1]);

                    if (seconds > 0) {
                        seconds--;
                    } else if (minutes > 0) {
                        minutes--;
                        seconds = 59;
                    } else {
                        // When countdown finishes, refresh the page
                        location.reload();
                        return;
                    }

                    timeElement.innerText = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2,
                        '0');
                }, 1000);
            });
        </script>
    @endpush
</div>
