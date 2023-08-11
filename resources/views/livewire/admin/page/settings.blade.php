<div>
    {{-- make tabs with alpine for the page table & visual builder  --}}
    <div x-data="{ activeTab: 'list' }">
        <div class="flex flex-col md:flex-row">
            <div class="flex-grow">
                <ul class="flex border-b">
                    <li @click="activeTab = 'list'" class="mr-1">
                        <a :class="{ 'border-l border-t border-r rounded-t text-blue-700': activeTab === 'list' }"
                            class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                            {{ __('List') }}
                        </a>
                    </li>
                    <li @click="activeTab = 'menuBuilder'" class="mr-1">
                        <a :class="{ 'border-l border-t border-r rounded-t text-blue-700': activeTab === 'builder' }"
                            class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                            {{ __('Menu Builder') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full px-6  my-4" x-show="activeTab === 'list'">
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
                            class="p-3 leading-5 bg-white text-gray-500 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            placeholder="{{ __('Search') }}" />
                    </div>
                </div>
            </div>

            <x-table>
                <x-slot name="thead">
                    <x-table.th>#</x-table.th>
                    <x-table.th sortable wire:click="sortBy('page_id')" :direction="$sorts['page_id'] ?? null">
                        {{ __('Page') }}
                        @include('components.table.sort', ['field' => 'page_id'])
                    </x-table.th>
                    <x-table.th>
                        {{ __('Language') }}
                    </x-table.th>
                    <x-table.th>
                        {{ __('Actions') }}
                    </x-table.th>
                </x-slot>
                <x-table.tbody>
                    @forelse($pagesettings as $pagesetting)
                        <x-table.tr>
                            <x-table.td>
                                <x-button success type="button" x-on:click="isOpen = !isOpen">
                                    <i class="fas fa-cog"></i>
                                </x-button>
                            </x-table.td>
                            <x-table.td>
                                {{ $pagesetting->page_id }}
                            </x-table.td>
                            <x-table.td>
                                {{ $pagesetting->language->name }}
                            </x-table.td>
                            <x-table.td>
                                <div class="inline-flex">
                                    <x-button danger type="button"
                                        wire:click="$emit('deleteModal', {{ $pagesetting->id }})"
                                        wire:loading.attr="disabled">
                                        <i class="fas fa-trash-alt"></i>
                                    </x-button>
                                </div>
                            </x-table.td>
                        </x-table.tr>
                        <x-table.tr x-show="openSettings === {{ $pagesetting->id }}" class="bg-gray-100">
                            <x-table.td colspan="4">
                                <form wire:submit.prevent="updatePageSettings({{ $pagesetting->id }})">
                                </form>
                            </x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.tr>
                            <x-table.td colspan="10" class="text-center">
                                {{ __('No entries found.') }}
                            </x-table.td>
                        </x-table.tr>
                    @endforelse
                </x-table.tbody>
            </x-table>

            <div class="card-body">
                <div class="pt-3">
                    @if ($this->selectedCount)
                        <p class="text-sm leading-5">
                            <span class="font-medium">
                                {{ $this->selectedCount }}
                            </span>
                            {{ __('Entries selected') }}
                        </p>
                    @endif
                    {{ $pagesettings->links() }}
                </div>
            </div>
        </div>

        <div class="w-full px-6  my-4" x-show="activeTab === 'menuBuilder'">
            @livewire('admin.menu.index')
        </div>
    </div>
</div>
