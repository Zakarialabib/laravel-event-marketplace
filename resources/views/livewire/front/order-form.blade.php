<div>
    <div class="mx-auto mb-4 border-b" x-data="{ isOpen: true }">
        <div class="flex justify-center mb-4">
            <h5 class="text-gray-500 font-bold text-center text-md font-heading uppercase py-2">
                <button type="button" class="text-blue-500 hover:text-blue-300 transition cursor-pointer"
                    x-on:click="isOpen = !isOpen">
                    <i class="fa fa-chevron-down"></i>
                    {{ __('Order form Now') }}
                    <i class="fa fa-chevron-down"></i>
                </button>
            </h5>
        </div>
        <div class="flex flex-wrap items-center" x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90" x-cloak>
            <form wire:submit.prevent="save" class="w-full flex flex-wrap">
                <div class="w-full md:w-1/2 px-2">
                    <x-label for="name" :value="__('FullName')" />
                    <x-input wire:model.defer="name" id="name" type="text" />
                    <x-input-error :messages="$errors->get('name')" for="name" class="mt-2" />


                </div>
                <div class="w-full md:w-1/2 px-2">
                    <x-label for="phone" :value="__('Phone')" />
                    <x-input wire:model.defer="phone" id="phone" type="tel" />
                    <x-input-error :messages="$errors->get('phone')" for="phone" class="mt-2" />

                </div>
                <div class="w-full px-2">
                    <x-label for="address" :value="__('Address')" />
                    <x-input wire:model.defer="address" id="address" type="text" />
                    <x-input-error :messages="$errors->get('address')" for="address" class="mt-2" />

                </div>

                <div class="w-full px-2">
                    <x-label for="message" :value="__('Message')" />
                    <textarea wire:model.defer="message" id="message"
                        class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                        rows="3"></textarea>
                </div>

                <div class="w-full flex py-2 justify-center">
                    <button type="submit" wire:loading.attr="disabled"
                        class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-green-400 hover:bg-green-200 transition cursor-pointer">
                        {{ __('Order Now') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
