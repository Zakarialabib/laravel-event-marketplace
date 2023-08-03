<div>

    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="register">

       
        <div class="flex flex-wrap space-y-2 mx-2">
            <!-- Name -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="name" :value="__('Name')" required />

                <x-text-input id="name" wire:model="name" class="block mt-1 w-full" type="text"
                    name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="email" :value="__('Email')" required />

                <x-text-input id="email" wire:model="email" class="block mt-1 w-full" type="email"
                    name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Phone -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="phone" :value="__('Phone')" required />

                <x-text-input id="phone" wire:model="phone" class="block mt-1 w-full" type="number"
                    name="phone" :value="old('phone')" required />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            
            <!-- Country -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-label for="country" :value="__('Country')" required />

                <x-input id="country" class="block mt-1 w-full" wire:model="country" type="text" name="country" :value="old('country')"
                    disabled />
            </div>

            <!-- City -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-label for="city" :value="__('City')" required />

                <x-input id="city" class="block mt-1 w-full" wire:model="city" type="text" name="city" :value="old('city')"
                    required />
            </div>

            <!-- Password -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="password" :value="__('Password')" required />

                <x-text-input id="password" wire:model="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="lg:w-1/2 sm:w-full px-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" required />

                <x-text-input id="password_confirmation" wire:model="passwordConfirmation"
                    class="block mt-1 w-full" type="password" name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex px-4 items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" x-on:click.prevent="isTab = 'login'">
                {{ __('Already registered?') }}
            </a>

            <x-button type="submit" primary class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</div>
