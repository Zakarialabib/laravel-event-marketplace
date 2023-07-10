<div>
    <form wire:submit.prevent="register">
        <div class="mx-auto mb-4 ">
            <div class="flex justify-center mb-4">
                <p
                    class="w-full text-center mb-6 py-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                    {{ __('Participant Information') }}
                </p>
            </div>
            <div class="bg-white rounded p-4 mx-6">
                <x-validation-errors class="mb-4" :errors="$errors" />
                <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 items-cente">
                    <div>

                        <x-label for="number_of_participants" for="number_of_participants" :value="__('Number of participants (si relais)')" />
                        <x-input type="number" id="number_of_participants"
                            wire:model.defer="race.numberOfParticipants" />
                        <x-input-error :messages="$errors->get('race.numberOfParticipants')" for="race.numberOfParticipants" class="mt-2" />
                    </div>
                    <div>
                        <x-label required for="email" :value="__('Email')" />
                        <x-input wire:model.defer="race.email" required type="email" />
                        <x-input-error :messages="$errors->get('race.email')" for="race.email" class="mt-2" />
                    </div>
                    <div>
                        <x-label required for="firstName" :value="__('First name')" />
                        <x-input wire:model.defer="race.firstName" required type="text" required />
                        <x-input-error :messages="$errors->get('race.firstName')" for="race.firstName" class="mt-2" />
                    </div>
                    <div>
                        <x-label required for="lastName" :value="__('Last name')" />
                        <x-input wire:model.defer="race.lastName" required type="text" />
                        <x-input-error :messages="$errors->get('race.lastName')" for="race.lastName" class="mt-2" />
                    </div>
                    <div>
                        <x-label required for="phoneNumber" :value="__('Phone number')" />
                        <x-input wire:model.defer="race.phoneNumber" required type="number" />
                        <x-input-error :messages="$errors->get('race.phoneNumber')" for="race.phoneNumber" class="mt-2" />
                    </div>
                    <div>
                        <x-label required for="country" :value="__('Country')" />
                        <x-input wire:model.defer="race.country" type="text" required />
                        <x-input-error :messages="$errors->get('race.country')" for="race.country" class="mt-2" />
                    </div>
                    <div>
                        <x-label required for="city" :value="__('City')" />
                        <x-input wire:model.defer="race.city" required type="text" />
                        <x-input-error :messages="$errors->get('race.city')" for="race.city" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="zipCode" :value="__('Zip code')" />
                        <x-input wire:model.defer="race.zipCode" type="text" />
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
                        <select wire:model.defer="race.gender"
                            class="block w-full py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                            <option value="Men">{{ __('Men') }}</option>
                            <option value="Women">{{ __('Women') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('race.gender')" for="race.gender" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="emergencyContactName" :value="__('Emergency contact name')" />
                        <x-input wire:model.defer="race.emergencyContactName" type="text" />
                        <x-input-error :messages="$errors->get('race.emergencyContactName')" for="race.emergencyContactName" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="emergencyContactPhoneNumber" :value="__('Emergency contact phone number')" />
                        <x-input wire:model.defer="race.emergencyContactPhoneNumber" type="number" />
                        <x-input-error :messages="$errors->get('race.emergencyContactPhoneNumber')" for="race.emergencyContactPhoneNumber" class="mt-2" />
                    </div>
                    <div class="col-span-full">
                        <x-label required for="address" :value="__('Address')" />
                        <x-input wire:model.defer="race.address" type="text" required />
                        <x-input-error :messages="$errors->get('race.address')" for="race.address" class="mt-2" />
                    </div>

                </div>

                <div class="w-full flex flex-wrap py-6 justify-between gap-4">
                    <div class="w-full">
                        <label for="helthInformation"
                            class="font-bold font-heading text-gray-600">{{ __('Health Informations') }}</label>
                        <textarea wire:model.defer="race.helthInformation" name="" id="" rows="5"
                            class="w-full border border-gray-200 rounded-md"></textarea>
                            <x-input-error :messages="$errors->get('race.helthInformation')" for="race.helthInformation" class="mt-2" />
                    </div>
                    <div class="">
                        <label for=""
                            class="font-bold font-heading text-gray-600">{{ __('has Medical History') }}</label>
                        <input wire:model.defer="race.hasMedicalHistory" type="checkbox" />
                    </div>
                    <div class="">
                        <label for=""
                            class="font-bold font-heading text-gray-600">{{ __('is Taking Medications') }}</label>
                        <input wire:model.defer="race.isTakingMedications" type="checkbox" />
                    </div>
                    <div class="">
                        <label for=""
                            class="font-bold font-heading text-gray-600">{{ __('has Medication Allergies') }}</label>
                        <input wire:model.defer="race.hasMedicationAllergies" type="checkbox" />
                    </div>
                    <div class="">
                        <label for=""
                            class="font-bold font-heading text-gray-600">{{ __('has Sensitivities') }}</label>
                        <input wire:model.defer="race.hasSensitivities" type="checkbox" />
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

                    <div class="flex items-center text-left py-2 mb-2">
                        <x-label for="newsletters" :value="__('Register into promotional email')" />
                        <x-input.checkbox wire:model.defer="newsletters" type="checkbox" />
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
