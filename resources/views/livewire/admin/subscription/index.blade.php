<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-col my-md-0 my-2">
            <div class="my-2 my-md-0">
                <p class="leading-5 text-black mb-1 text-sm ">
                    {{ __('Show items per page') }}
                </p>
                <select wire:model="perPage" name="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-1">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="my-2 my-md-0">
                <input type="text" wire:model.debounce.300ms="search"
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>
        </div>
    </div>

    <table class="w-full rounded-t-lg m-5 mx-auto bg-gray-800 text-gray-200">
        <thead>
            <tr class="text-left border-b border-gray-300">
                <th class="px-4 py-3">
                    {{ __('Subscription name') }}
                </th>
                <th class="px-4 py-3">
                    {{ __('Subscription description') }}
                </th>
                <th class="px-4 py-3">
                    {{ __('Price') }}
                </th>
                <th class="px-4 py-3">
                    {{ __('Actions') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subscriptions as $subscription)
                <tr class="bg-gray-700 border-b border-gray-600">
                    <td class="px-4 py-3">
                        {{ $subscription->name }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $subscription->details }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $subscription->pivot->price }}
                    </td>
                    <td class="px-4 py-3">
                        <x-button primary type="button" wire:click="$emit('editModal', {{ $subscription->id }})"
                            wire:loading.attr="disabled">
                            <i class="fas fa-edit"></i>
                        </x-button>
                        <x-button primary type="button" wire:click="approve({{ $subscription->id }})"
                            wire:loading.attr="disabled">
                            <i class="fas fa-edit"></i>
                        </x-button>
                        <x-button danger type="button" wire:click="$emit('deleteModal', {{ $subscription->id }})"
                            wire:loading.attr="disabled">
                            <i class="fas fa-trash-alt"></i>
                        </x-button>
                        <x-button danger type="button" wire:click="renewModal({{ $subscription->id }})"
                            wire:loading.attr="disabled">
                            <i class="fas fa-trash-alt"></i>
                        </x-button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>{{ __('No entries found.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <x-modal wire:click="renewModal">
        <x-slot name="title">
            {{ __('Renew user subscription') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="renew">
                <div class="lg:w-1/3 sm:w-1/2 px-2 mt-5 {{ $errors->has('start_date') ? 'is-invalid' : '' }}">
                    <label for="start_date">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" id="start_date" disabled wire:model="start_date" />
                    {{-- <x-input-error for="email" /> --}}
                </div>
                <div class="lg:w-1/3 sm:w-1/2 px-2 mt-5 {{ $errors->has('end_date') ? 'is-invalid' : '' }}">
                    <label for="end_date">{{ __('End Date') }}</label>
                    <input type="date" name="end_date" id="end_date" wire:model="end_date" />
                    {{-- <x-input-error for="phone" /> --}}
                </div>
                <x-button type="submit" primaryF>
                    {{ __('Renew') }}
                </x-button>
            </form>
        </x-slot>
    </x-modal>

</div>
