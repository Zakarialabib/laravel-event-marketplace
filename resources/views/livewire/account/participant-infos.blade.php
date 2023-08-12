<div>
    <h2 class="text-2xl font-bold font-heading text-gray-700 mb-4">
        {{ __('Participation Information') }}
    </h2>
    <form wire:submit.prevent="save">
        <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 items-cente">
            <div>
                <x-label required for="email" :value="__('Email')" />
                <x-input wire:model.defer="participant.email" required id="email" name="email" type="email"
                    autocomplete="email" />
                <x-input-error :messages="$errors->get('participant.email')" for="participant.email" class="mt-2" />
            </div>
            <div>
                <x-label required for="name" :value="__('Name')" />
                <x-input wire:model.defer="participant.name" required type="text" id="name" name="name"
                    required autocomplete="name" />
                <x-input-error :messages="$errors->get('participant.name')" for="participant.name" class="mt-2" />
            </div>

            <div>
                <x-label required for="phone_number" :value="__('Phone number')" />
                <x-input wire:model.defer="participant.phone_number" required type="tel" id="phone_number"
                    name="phone_number" autocomplete="phone_number" />
                <x-input-error :messages="$errors->get('participant.phone_number')" for="participant.phone_number" class="mt-2" />
            </div>
            <div>
                <x-label required for="country" :value="__('Country')" />
                <x-input wire:model.defer="participant.country" type="text" required id="country" name="country" />
                <x-input-error :messages="$errors->get('participant.country')" for="participant.country" class="mt-2" />
            </div>
            <div>
                <x-label required for="city" :value="__('City')" />
                <x-input wire:model.defer="participant.city" required type="text" id="city" name="city" />
                <x-input-error :messages="$errors->get('participant.city')" for="participant.city" class="mt-2" />
            </div>
            <div>
                <x-label for="zip_code" :value="__('Zip code')" />
                <x-input wire:model.defer="participant.zip_code" type="text" id="zip_code" name="zip_code" />
                <x-input-error :messages="$errors->get('participant.zip_code')" for="participant.zip_code" class="mt-2" />
            </div>
            <div>
                <x-label for="birth_date" :value="__('date of birth')" required />
                <x-date-picker id="date_id" picker="date" required name="date"
                    wire:model="participant.birth_date" />
                <x-input-error :messages="$errors->get('participant.birth_date')" for="participant.birth_date" class="mt-2" />
            </div>
            <div>
                <x-label required :value="__('Gender')" for="gender" />
                <select wire:model.defer="participant.gender" id="gender"
                    class="block w-full py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                    <option>{{ __('Select options') }}</option>
                    <option value="Men">{{ __('Men') }}</option>
                    <option value="Women">{{ __('Women') }}</option>
                </select>
                <x-input-error :messages="$errors->get('participant.gender')" for="participant.gender" class="mt-2" />
            </div>
            <div>
                <x-label for="emergency_contact_name" :value="__('Emergency contact name')" />
                <x-input wire:model.defer="participant.emergency_contact_name" name="emergency_contact_name"
                    type="text" />
                <x-input-error :messages="$errors->get('participant.emergency_contact_name')" for="participant.emergency_contact_name" class="mt-2" />
            </div>
            <div>
                <x-label for="emergency_contact_phone_number" :value="__('Emergency contact phone number')" />
                <x-input wire:model.defer="participant.emergency_contact_phone_number"
                    name="emergency_contact_phone_number" type="number" />
                <x-input-error :messages="$errors->get('participant.emergency_contact_phone_number')" for="participant.emergency_contact_phone_number" class="mt-2" />
            </div>
            <div class="col-span-full">
                <x-label required for="address" :value="__('Address')" />
                <x-input wire:model.defer="participant.address" type="text" required id="address" name="address" />
                <x-input-error :messages="$errors->get('participant.address')" for="participant.address" class="mt-2" />
            </div>

        </div>

        <div class="w-full flex flex-wrap py-6 justify-between gap-4">
            <div class="w-full">
                <label for="health_informations"
                    class="font-bold font-heading text-gray-600">{{ __('Health Informations') }}</label>
                <x-input wire:model.defer="participant.health_informations" name="health_informations"
                    id="health_informations" />
                <x-input-error :messages="$errors->get('participant.health_informations')" for="participant.health_informations" class="mt-2" />
            </div>
            <div class="w-full">
                <label for="medical_history"
                    class="font-bold font-heading text-gray-600">{{ __('has Medical History') }}</label>
                <x-input wire:model.defer="participant.medical_history" type="text" id="medical_history" />
            </div>
            <div class="w-full">
                <label for="taking_medications"
                    class="font-bold font-heading text-gray-600">{{ __('is Taking Medications') }}</label>
                <x-input wire:model.defer="participant.taking_medications" type="text" id="taking_medications" />
            </div>
            <div class="w-full">
                <label for=""
                    class="font-bold font-heading text-gray-600">{{ __('has Medication Allergies') }}</label>
                <x-input wire:model.defer="participant.medication_allergies" type="text"
                    id="medication_allergies" />
            </div>
            <div class="w-full">
                <label for="sensitivities"
                    class="font-bold font-heading text-gray-600">{{ __('has Sensitivities') }}</label>
                <x-input wire:model.defer="participant.sensitivities" type="text" id="sensitivities" />
            </div>
        </div>
        <div class="w-full flex justify-center py-4 px-2">
            <x-button type="submit" primary>{{ __('Save changes') }}</x-button>
        </div>
    </form>
</div>
