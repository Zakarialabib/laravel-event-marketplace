<div>
    <form wire:submit.prevent="save" class="mx-auto mb-4 border-b" x-data="{ isOpen: false }">
        <div class="flex justify-center mb-4">
            <p class="text-gray-700 break-words scroll-smooth text-center">
                Sign up to be notified when 2024 registration will open up. <br>
                Notify me on opening dates, event announcements, future race dates, and in the case
                of a sellout, get the first
                opportunity to register should additional entries become available.
            </p>
            <h5 class="text-gray-500 font-bold text-center text-md font-heading uppercase py-2">
                <button type="button" class="text-blue-500 hover:text-blue-300 transition cursor-pointer"
                    x-on:click="isOpen = !isOpen">
                    <i class="fas fa-chevron-down"></i>
                    {{ __('Subscribe Now') }}
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
        <div class="flex flex-wrap items-center" x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90" x-cloak>

            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('FullName') }}</label>
                <input wire:model="name"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
            </div>
            <div class="w-full md:w-1/2 pr-2">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Phone') }}</label>
                <input wire:model="phone"
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="text">
            </div>
            <div class="w-full">
                <label class="font-bold font-heading text-gray-600" for="">{{ __('Email') }}</label>
                <input wire:model="email" 
                    class="block w-full mt-4 py-2 px-4 bg-white border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md"
                    type="email">
            </div>
            <div class="w-full flex py-2 justify-center">
                <button wire:click="save" wire:loading.attr="disabled"
                    class="block text-center text-white font-bold font-heading py-2 px-4 rounded-md uppercase bg-green-400 hover:bg-green-200 transition cursor-pointer">
                    {{ __('Subscribe Now') }}
                </button>
            </div>
        </div>
    </form>
</div>
