<div>
    <h3 class="py-6 text-xl font-bold font-heading">{{ __('Join our Newsletter') }}</h3>
    <form wire:submit.prevent="subscribe">
        <div class="mb-6 relative lg:mx-auto bg-white rounded-lg">
            <div class="relative flex flex-wrap items-center justify-between">
                <div class="relative flex-1">
                    <span
                        class="absolute top-0 left-0 ml-8 mt-4 font-semibold font-heading text-xs text-gray-400">{{ __('Drop your e-mail') }}</span>
                    <input wire:model="email" type="email" name="email"
                    placeholder="{{__('youradress@mail.com') }}"
                        class="inline-block w-full pt-8 pb-4 px-8 placeholder-gray-400 border-0 focus:ring-green-400 focus:outline-green-400 rounded-md">
                    <x-input-error :messages="$errors->get('email')" for="email" class="mt-2" />
                </div>
                <button type="submit"
                    class="inline-block w-auto cursor-pointer bg-green-600 hover:bg-green-400 text-white font-bold font-heading py-4 px-6 rounded-md uppercase text-center transition">
                    {{ __('Join') }}
                </button>
            </div>
        </div>
    </form>
    <hr>
</div>
