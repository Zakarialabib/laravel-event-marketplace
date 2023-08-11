<section class="text-gray-900 my-2 p-4 mx-auto bg-white dark:bg-slate-900">

    <h1 class="text-2xl tracking-tighter font-extrabold text-center text-green-900 dark:text-green-500">
        {{ __('Tell us what you need') }}</h1>


    <div class="text-center">
        <x-validation-errors class="mb-4" :errors="$errors" />
    </div>

    <div class="md:w-full sm:w-full">
        <form wire:submit.prevent="submit">
            <div class="p-2 w-full">
                <div class="relative">
                    <input type="text" wire:model="contact.name" id="name" name="name"
                        placeholder="{{ __('Full name') }}" value="{{ old('name') }}"
                        class="@error('contact.name') is-invalid @enderror w-full bg-gray-100 dark:bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-gray-700 py-1 px-3 leading-3 transition-colors duration-200 ease-in-out">
                    <x-input-error :messages="$errors->get('contact.name')" for="contact.name" class="mt-2" />
                </div>
            </div>
            <div class="p-2 w-full">
                <div class="relative">
                    <input type="email" wire:model="contact.email" id="email" name="email"
                        placeholder="{{ __('Enter your email') }}" value="{{ old('email') }}"
                        class="@error('contact.email') is-invalid @enderror w-full bg-gray-100 dark:bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-gray-700 py-1 px-3 leading-3 transition-colors duration-200 ease-in-out">
                    <x-input-error :messages="$errors->get('contact.email')" for="contact.email" class="mt-2" />
                </div>
            </div>
            <div class="p-2 w-full">
                <div class="relative">
                    <input type="tel" wire:model="contact.phone_number" id="phone_number" name="phone_number"
                        placeholder="{{ __('Enter your Phone Number') }}" value="{{ old('phone_number') }}"
                        class="@error('phone_number') is-invalid @enderror w-full bg-gray-100 dark:bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-gray-700 py-1 px-3 leading-3 transition-colors duration-200 ease-in-out">
                    <x-input-error :messages="$errors->get('contact.phone_number')" for="contact.phone_number" class="mt-2" />
                </div>
            </div>
            <div class="p-2 w-full h-full">
                <div class="relative">
                    <textarea id="message" wire:model="contact.message" name="message" placeholder="Message" value="{{ old('message') }}"
                        class="w-full h-48 bg-gray-100 dark:bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-gray-700 py-1 px-3 leading-6 transition-colors duration-200 ease-in-out"></textarea>
                    <x-input-error :messages="$errors->get('contact.message')" for="contact.message" class="mt-2" />
                </div>
            </div>
            <div class="p-2 w-full">
                <button
                    class="md:text-sm sm:text-xs bg-green-900 dark:text-green-500 text-white hover:text-green-800 hover:bg-green-100 active:bg-green-200 focus:ring-green-300 text-sm font-bold uppercase px-6 py-2 rounded-md shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150">
                    <span>
                        <div wire:loading wire:target="submit">
                            <x-loading />
                        </div>
                        <span>{{ __('Send Message') }}</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</section>
