<div>
    <form wire:submit.prevent="store">
        <div class="mx-auto mb-4 ">
            <div class="flex justify-center mb-4">
                <p class="w-full text-center mb-6 py-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                    {{ __('Participant Information') }}
                </p>
            </div>
            <div class="bg-white rounded p-4 mx-6">
                <div class="grid grid-cols-2 gap-4 items-cente">
                    <p>
                        <label class="font-bold font-heading text-gray-600" for="number_of_participants">
                            {{ __('Nombre de participants') }} (si relais)</label>
                        <x-input type="number" id="number_of_participants"
                            wire:model.defer="race.numberOfParticipants" />
                        @error('numberOfParticipants')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('Email') }}</label>
                        <x-input wire:model.defer="race.email" required type="email" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('First name') }}</label>
                        <x-input wire:model.defer="race.firstName" required type="text" />
                        @error('firstName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('Last name') }}</label>
                        <x-input wire:model.defer="race.lastName" required type="text" />
                        @error('lastName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('Phone') }}</label>
                        <x-input wire:model.defer="race.phone" required type="number" />
                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('Country') }}</label>
                        <x-input wire:model.defer="race.country" type="text" required />
                        @error('country')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('City') }}</label>
                        <x-input wire:model.defer="race.city" required type="text" />
                        @error('city')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" for="">{{ __('Zip Code') }}</label>
                        <x-input wire:model.defer="race.zipCode" type="text" />
                        @error('zipCode')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('date Of Birth') }}</label>
                        <x-input wire:model.defer="race.dateOfBirth" type="date" />
                        @error('dateOfBirth')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('Gender') }}</label>
                        <select wire:model.defer="race.gender"
                            class="block w-full py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                        @error('gender')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p class="col-span-full">
                        <label class="font-bold font-heading text-gray-600" required
                            for="">{{ __('Address') }}</label>
                        <x-input wire:model.defer="race.address" type="text" />
                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label for=""
                            class="font-bold font-heading text-gray-600">{{ __('Emergency Contact Name') }}</label>
                        <x-input wire:model.defer="race.emergencyContactName" type="text" />
                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label for=""
                            class="font-bold font-heading text-gray-600">{{ __('Emergency Contact Phone Number') }}</label>
                        <x-input wire:model.defer="race.emergencyContactPhoneNumber" type="number" />
                        @error('emergencyContactPhoneNumber')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </p>
                </div>
                

               
                <div class="w-full flex flex-wrap py-6 justify-between gap-4">
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
                        <h3>Additional services</h3>
                        <!-- Display and handle additional services selection -->
                        <!-- Each additional service should have its name, description, price, and photo fields -->
                    </div>
                @endif

                <div class="w-full grid grid-cols-2 sm:grid sm:grid-cols-1 py-4 gap-4 justify-between sm:justify-center">
                    <p>{{ __('We will send details about your registration your email with account access') }}</p>
                    <div class="flex items-center text-left py-2 mb-2">
                        <label for=""
                            class="font-bold font-heading pr-6 text-gray-600 py-4">{{ __('Register into promotional email') }}</label>
                        
                        <x-input.checkbox wire:model.defer="newsletters" type="checkbox" />
                    </div>
                    <button type="submit" wire:loading.attr="disabled"
                        class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-redBrick-600 hover:bg-redBrick-200 transition cursor-pointer">
                        {{ __('Registration') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
