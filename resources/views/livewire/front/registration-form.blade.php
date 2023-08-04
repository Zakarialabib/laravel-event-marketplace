<div>
    <form wire:submit.prevent="register" class="mx-auto mb-4 ">
        <h3
            class="w-full text-center mb-6 py-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
            {{ __('Participant Information') }}
        </h3>
        <div class="bg-white rounded p-4 mx-6">
            <x-validation-errors class="mb-4" :errors="$errors" />
            <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 items-cente">
                <div>
                    <x-label for="numberOfParticipants" :value="__('Number of participants (si relais)')" />
                    <x-input type="number" id="numberOfParticipants" name="numberOfParticipants"
                        wire:model="race.numberOfParticipants" />
                    <x-input-error :messages="$errors->get('race.numberOfParticipants')" for="race.numberOfParticipants" class="mt-2" />
                </div>
                <div>
                    <x-label required for="email" :value="__('Email')" />
                    <x-input wire:model="race.email" required id="email" name="email" type="email"
                        autocomplete="email" />
                    <x-input-error :messages="$errors->get('race.email')" for="race.email" class="mt-2" />
                </div>
                <div>
                    <x-label required for="firstName" :value="__('First name')" />
                    <x-input wire:model="race.firstName" required type="text" id="firstName" name="firstName"
                        required autocomplete="firstName" />
                    <x-input-error :messages="$errors->get('race.firstName')" for="race.firstName" class="mt-2" />
                </div>
                <div>
                    <x-label required for="lastName" :value="__('Last name')" />
                    <x-input wire:model="race.lastName" required type="text" id="lastName" name="lastName"
                        autocomplete="lastName" />
                    <x-input-error :messages="$errors->get('race.lastName')" for="race.lastName" class="mt-2" />
                </div>
                <div>
                    <x-label required for="phoneNumber" :value="__('Phone number')" />
                    <x-input wire:model="race.phoneNumber" required type="number" id="phoneNumber"
                        name="phoneNumber" autocomplete="phoneNumber" />
                    <x-input-error :messages="$errors->get('race.phoneNumber')" for="race.phoneNumber" class="mt-2" />
                </div>
                <div>
                    <x-label required for="country" :value="__('Country')" />
                    <x-input wire:model="race.country" type="text" required id="country" name="country" />
                    <x-input-error :messages="$errors->get('race.country')" for="race.country" class="mt-2" />
                </div>
                <div>
                    <x-label required for="city" :value="__('City')" />
                    <x-input wire:model="race.city" required type="text" id="city" name="city" />
                    <x-input-error :messages="$errors->get('race.city')" for="race.city" class="mt-2" />
                </div>
                <div>
                    <x-label for="zipCode" :value="__('Zip code')" />
                    <x-input wire:model="race.zipCode" type="text" id="zipCode" name="zipCode" />
                    <x-input-error :messages="$errors->get('race.zipCode')" for="race.zipCode" class="mt-2" />
                </div>
                <div>
                    <x-label for="dateOfbirth" :value="__('date of birth')" required />
                    <x-date-picker id="date_id" picker="date" required name="date"
                        wire:model="race.dateOfBirth" />
                    <x-input-error :messages="$errors->get('race.dateOfBirth')" for="race.dateOfBirth" class="mt-2" />
                </div>
                <div>
                    <x-label required :value="__('Gender')" for="gender" />
                    <select wire:model="race.gender" id="gender"
                        class="block w-full py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                        <option>{{ __('Select options') }}</option>
                        <option value="Men">{{ __('Men') }}</option>
                        <option value="Women">{{ __('Women') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('race.gender')" for="race.gender" class="mt-2" />
                </div>
                <div>
                    <x-label for="emergencyContactName" :value="__('Emergency contact name')" />
                    <x-input wire:model="race.emergencyContactName" name="emergencyContactName" type="text" />
                    <x-input-error :messages="$errors->get('race.emergencyContactName')" for="race.emergencyContactName" class="mt-2" />
                </div>
                <div>
                    <x-label for="emergencyContactPhoneNumber" :value="__('Emergency contact phone number')" />
                    <x-input wire:model="race.emergencyContactPhoneNumber" name="emergencyContactPhoneNumber"
                        type="number" />
                    <x-input-error :messages="$errors->get('race.emergencyContactPhoneNumber')" for="race.emergencyContactPhoneNumber" class="mt-2" />
                </div>
                <div class="col-span-full">
                    <x-label required for="address" :value="__('Address')" />
                    <x-input wire:model="race.address" type="text" required id="address" name="address" />
                    <x-input-error :messages="$errors->get('race.address')" for="race.address" class="mt-2" />
                </div>

            </div>
            <div class="col-span-full">
                <!-- Health-Related Checkboxes -->
                <label class="font-bold font-heading text-gray-600">{{ __('Health Related Information') }}</label>

                <div class="w-full flex flex-col py-6 justify-between gap-4" x-data="{ checkboxes: { showMedicalHistory: false, showTakingMedications: false, showMedicationAllergies: false, showSensitivities: false, showHealthInfo: false } }">
                    <div class="relative flex flex-wrap gap-6 items-center">
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                type="checkbox" id="showMedicalHistory" x-model="checkboxes.showMedicalHistory" />
                            <label for="showMedicalHistory"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer">
                            </label>
                        </div>
                        <p class="font-bold font-heading text-gray-800">
                            {{ __('has Medical History') }}
                        </p>

                        <div x-show="checkboxes.showMedicalHistory"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:leave="transition ease-in duration-150" class="w-full" x-cloak>
                            <x-input wire:model="race.hasMedicalHistory" type="text" id="hasMedicalHistory"
                                class="w-full block" name="hasMedicalHistory" />
                        </div>
                    </div>

                    <div class="relative flex flex-wrap gap-6 items-center">
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                type="checkbox" id="showTakingMedications"
                                x-model="checkboxes.showTakingMedications" />
                            <label for="showTakingMedications"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>
                        <p class="font-bold font-heading text-gray-800">
                            {{ __('is Taking Medications') }}
                        </p>
                        <div x-show="checkboxes.showTakingMedications" x-transition:enter="transition ease-out duration-200"
                            x-transition:leave="transition ease-in duration-150" class="w-full" class="bg-white py-5"
                            x-cloak>
                            <x-input wire:model="race.isTakingMedications" type="text" class="w-full block"
                                id="isTakingMedications" name="isTakingMedications" />
                        </div>
                    </div>

                    <div class="relative flex flex-wrap gap-6 items-center">
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                type="checkbox" id="showMedicationAllergies"
                                x-model="checkboxes.showMedicationAllergies" />
                            <label for="showMedicationAllergies"
                                class="toggle-label block overflow-hidden font-bold font-heading text-gray-800 h-6 rounded-full bg-gray-300 cursor-pointer">
                            </label>
                        </div>
                        <p class="font-bold font-heading text-gray-800">
                            {{ __('has Medication Allergies') }}
                        </p>
                        <div x-show="checkboxes.showMedicationAllergies" x-transition:enter="transition ease-out duration-200"
                            class="w-full" x-transition:leave="transition ease-in duration-150" x-cloak>
                            <x-input wire:model="race.hasMedicationAllergies" type="text"
                                class="w-full block" id="hasMedicationAllergies" name="hasMedicationAllergies" />
                        </div>
                    </div>

                    <div class="relative flex flex-wrap gap-6 items-center">
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                type="checkbox" id="showSensitivities"
                               x-model="checkboxes.showSensitivities" />
                            <label for="showSensitivities"
                                class="toggle-label block overflow-hidden font-bold font-heading text-gray-800 h-6 rounded-full bg-gray-300 cursor-pointer">
                            </label>
                        </div>
                        <p class="font-bold font-heading text-gray-800">
                            {{ __('has Sensitivities') }}
                        </p>
                        <div x-show="checkboxes.showSensitivities" x-transition:enter="transition ease-out duration-200"
                            x-transition:leave="transition ease-in duration-150" x-cloak class="w-full">
                            <x-input wire:model="race.hasSensitivities" type="text" id="hasSensitivities"
                                class="w-full block" name="hasSensitivities" />
                        </div>
                    </div>
                    <div class="relative flex flex-wrap gap-6 items-center">
                        <div
                            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                type="checkbox" id="showhealthInfo"x-model="checkboxes.showhealthInfo" />
                            <label for="showhealthInfo"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer">
                            </label>
                        </div>
                        <p class="font-bold font-heading text-gray-800">
                            {{ __('Health Informations') }}
                        </p>
                        <div x-show="checkboxes.showhealthInfo" x-transition:enter="transition ease-out duration-200"
                            class="w-full" x-transition:leave="transition ease-in duration-150" x-cloak>
                            <textarea wire:model="race.healthInformation" name="healthInformation" id="healthInformation" rows="5"
                                class="w-full border border-gray-200 rounded-md"></textarea>
                            <x-input-error :messages="$errors->get('race.healthInformation')" for="race.healthInformation" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Additional services section -->
                @if ($additionalServices)
                    <div class="w-full">
                        <h3>{{ __('Additional services') }}</h3>
                        <!-- Display and handle additional services selection -->
                        <!-- Each additional service should have its name, description, price, and photo fields -->
                    </div>
                @endif

                <div
                    class="w-full grid grid-cols-2 sm:grid sm:grid-cols-1 py-2 gap-2 justify-between sm:justify-center">

                    <div class="flex items-center text-center gap-4 py-2 mb-2">
                        <x-label for="newsletters" :value="__('Register into promotional email')" />
                        <x-input.checkbox wire:model="newsletters" type="checkbox" />
                    </div>
                    <button type="submit" wire:loading.attr="disabled"
                        class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-green-600 hover:bg-green-200 transition cursor-pointer">
                        {{ __('Registration') }}
                    </button>
                    <small>{{ __('We will send details about your registration your email with account access') }}</small>
                </div>
            </div>
        </div>
    </form>
</div>
