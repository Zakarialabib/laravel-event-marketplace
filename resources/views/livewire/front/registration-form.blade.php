<div>
    <form wire:submit.prevent="store" class="container mx-auto mb-4">
        <div class="flex justify-center mb-4">
            <h5 class="text-gray-500 font-bold text-center text-md font-heading uppercase py-2">
                {{ __('Participant Information') }}
            </h5>
        </div>
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('FullName') }}</label>
                <input wire:model="name"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label for="number_of_participants">Nombre de participants (si relais)</label>
                <input type="number" id="number_of_participants" wire:model="numberOfParticipants">
                @error('numberOfParticipants')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Email') }}</label>
                <x-input wire:model="email" required type="email" />
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Lirst name') }}</label>
                <x-input wire:model.defer="firstName" required type="text" />
                @error('firstName')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Last name') }}</label>
                <input wire:model.defer="lastName" required
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
                @error('lastName')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Phone') }}</label>
                <x-input wire:model.defer="phone" required type="number" />
                @error('phone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Country') }}</label>
                <x-input wire:model.defer="country" type="text" required />
                @error('country')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('City') }}</label>
                <x-input wire:model.defer="city" required type="text">
                @error('city')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Zip Code') }}</label>
                <x-input wire:model.defer="zipCode" type="text" />
                @error('zipCode')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('date Of Birth') }}</label>
                <input wire:model.defer="dateOfBirth"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="date">
                @error('dateOfBirth')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Gender') }}</label>
                <select wire:model.defer="gender"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md">
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                </select>
                @error('gender')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-full">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Address') }}</label>
                <input wire:model.defer="address"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
                @error('address')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-full md:w-1/2 pr-2">
                <label for=""
                    class="font-bold font-heading text-gray-600">{{ __('Emergency Contact Name') }}</label>
                <input wire:model.defer="emergencyContactName" type="text"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" />
                    @error('address')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label for=""
                    class="font-bold font-heading text-gray-600">{{ __('Emergency Contact Phone Number') }}</label>
                <input wire:model.defer="emergencyContactPhoneNumber" type="number"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" />
                    @error('emergencyContactPhoneNumber')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-wrap gap-2">
                <div class="">
                    <label for=""
                        class="font-bold font-heading text-gray-600">{{ __('has Medical History') }}</label>
                    <input wire:model.defer="hasMedicalHistory" type="checkbox"
                        class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" />
                </div>
                <div class="">
                    <label for=""
                        class="font-bold font-heading text-gray-600">{{ __('is Taking Medications') }}</label>
                    <input wire:model.defer="isTakingMedications" type="checkbox"
                        class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" />
                </div>
                <div class="">
                    <label for=""
                        class="font-bold font-heading text-gray-600">{{ __('has Medication Allergies') }}</label>
                    <input wire:model.defer="hasMedicationAllergies" type="checkbox"
                        class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" />
                </div>
                <div class="">
                    <label for=""
                        class="font-bold font-heading text-gray-600">{{ __('has cSensitivities') }}</label>
                    <input wire:model.defer="hasSensitivities" type="checkbox"
                        class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" />
                </div>
            </div>
            <!-- Additional services section -->
            <div>
                <h3>Additional services</h3>
                <!-- Display and handle additional services selection -->
                <!-- Each additional service should have its name, description, price, and photo fields -->
            </div>

            <div class="w-full flex py-2 justify-center">
                <button wire:click="save" wire:loading.attr="disabled"
                    class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-move-400 hover:bg-move-200 transition cursor-pointer">
                    {{ __('Registration') }}
                </button>
            </div>
        </div>
    </form>
</div>
