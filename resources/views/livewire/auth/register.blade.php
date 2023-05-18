<div>
    <h1 class="text-3xl md:text-xl font-bold text-center mb-4">
        {{ __('Register as') }}
    </h1>

    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="register">

        <div class="mt-4">
            <div class="flex space-y-2 flex-col items-center justify-center">
                <div class="flex flex-row space-x-2">
                    <label for="store-owner-toggle" class="text-xs text-gray-700">{{ __('Client') }}</label>
                    <div
                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="store-owner-toggle" id="store-owner-toggle"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                            wire:model.lazy="isStoreOwner">
                        <label for="store-owner-toggle"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <label for="store-owner-toggle" class="text-xs text-gray-700">{{ __('Store Owner') }}</label>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap space-y-2 mx-2">
            <!-- Name -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="name" :value="__('Name')" required />

                <x-text-input id="name" wire:model.lazy="name" class="block mt-1 w-full" type="text"
                    name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="email" :value="__('Email')" required />

                <x-text-input id="email" wire:model.lazy="email" class="block mt-1 w-full" type="email"
                    name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Phone -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="phone" :value="__('Phone')" required />

                <x-text-input id="phone" wire:model.lazy="phone" class="block mt-1 w-full" type="number"
                    name="phone" :value="old('phone')" required />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            
            <!-- Country -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-label for="country" :value="__('Country')" required />

                <x-input id="country" class="block mt-1 w-full" wire:model.lazy="country" type="text" name="country" :value="old('country')"
                    disabled />
            </div>

            <!-- City -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-label for="city" :value="__('City')" required />

                <x-input id="city" class="block mt-1 w-full" wire:model.lazy="city" type="text" name="city" :value="old('city')"
                    required />
            </div>

            <!-- Password -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="password" :value="__('Password')" required />

                <x-text-input id="password" wire:model.lazy="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" required />

                <x-text-input id="password_confirmation" wire:model.lazy="passwordConfirmation"
                    class="block mt-1 w-full" type="password" name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Additional fields for store owners -->
            @if ($isStoreOwner)
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="store_name" :value="__('Store Name')" required />

                    <x-text-input id="store_name" wire:model.lazy="storeName" class="block mt-1 w-full" type="text"
                        name="store_name" :value="old('store_name')" required />

                    <x-input-error :messages="$errors->get('store_name')" class="mt-2" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="store_url" :value="__('Store URL')" required />

                    <x-text-input id="store_url" wire:model.lazy="storeUrl" class="block mt-1 w-full" type="text"
                        name="store_url" :value="old('store_url')" />

                    <x-input-error :messages="$errors->get('store_url')" class="mt-2" required />
                </div>

                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-input-label for="store_phone" :value="__('Store Phone')" required />

                    <x-text-input id="store_phone" wire:model.lazy="storePhone" class="block mt-1 w-full" type="number"
                        name="store_phone" :value="old('store_phone')" required />

                    <x-input-error :messages="$errors->get('store_phone')" class="mt-2" />
                </div>
            @endif
        </div>

        <div class="flex px-4 items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button type="submit" primary class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</div>
