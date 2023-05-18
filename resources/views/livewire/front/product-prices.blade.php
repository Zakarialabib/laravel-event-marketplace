<div>
    <div class="relative w-full flex-wrap gap-2 h-full rounded-lg">

        <div class="h-[3rem] w-auto">
            <input type="text" wire:model.debounce.300="search" placeholder="{{ __('Search for products') }}"
                autocomplete=""
                class="w-full h-full text-lg border-0 focus:ring-transparent bg-gray-100 text-gray-900 text-xs focus:outline-none py-2 rounded-md">
        </div>

        <div class="block">
            @if (!empty($search))
                <h2 class="text-lg text-center font-medium mb-2">{{ __('Where to buy') }} "{{ $search }}"</h2>
                @if (!empty($results))
                    <div class="overflow-y-scroll h-[25rem]">
                        @forelse ($results as $store)
                            <div class="flex items-center px-4 py-3 border-b border-gray-200"
                                wire:loading.class.delay="opacity-50" wire:key="row-{{ $store->id }}">
                                <div class="flex-grow">
                                    <h4 class="text-md font-bold text-move-400">{{ $store->name }}</h4>
                                    {{-- <p class="text-sm text-gray-500">{{ $store->location }}</p> --}}
                                </div>
                                <div class="flex-none">
                                    <a href=""
                                        class="px-4 py-2 bg-move-600 hover:bg-move-700 text-white rounded-lg inline-flex items-center">
                                        <span>{{ __('Buy Now') }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M14.707 11.707a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L10 14.586l3.293-3.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v7.586l3.293-3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0L11 15.414V17a1 1 0 11-2 0V4a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-center px-4 py-3">
                                <x-button primary type="button" wire:click="loadMore" wire:loading.attr="disabled">
                                    {{ __('load more') }}
                                </x-button>
                            </div>
                        @empty
                            <div
                                class="flex-none px-4 py-2 text-center text-white hover:text-move-700 items-center">
                                <span>{{ __('Nothing found') }}</span>
                            </div>
                        @endforelse
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
