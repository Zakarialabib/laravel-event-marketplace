<div>
    <div class="relative flex flex-col p-8 shadow-sm rounded-2xl border-skin-base bg-skin-card/50 backdrop-blur-sm"
        x-data="{ openDropdown: false }">
        <h3 class="text-neutral-700 text-4xl font-semibold mb-5 ">
            {{ __('Race Results for') }} {{ $race->name }}
        </h3>
        @if ($results->isEmpty())
            <div class="bg-green-50 border border-green-200 p-6 rounded-md shadow-sm">
                <p class="text-center text-green-700">
                    {{ __('No results available at the moment. for') }} {{ $race->name }}.
                </p>
            </div>
        @else
            <div class="w-full flex flex-wrap justify-between gap-2 items-center">
                <select wire:model.defer="perPage" name="perPage"
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500 block w-32">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>

                <input type="text" wire:model.lazy="search"
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-gray-300 mb-1 text-sm block focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>

            <x-table>
                <x-slot name="thead">
                    <x-table.th>#</x-table.th>
                    <x-table.th>
                        {{ __('Athlete') }}
                    </x-table.th>
                    <x-table.th>
                        {{ __('Finish') }}
                    </x-table.th>
                    <x-table.th>
                        {{ __('Overall Rank') }}
                    </x-table.th>
                    <x-table.th>
                        {{ __('Date') }}
                    </x-table.th>
                </x-slot>
                <tbody class="table-row-group align-middle">
                    @forelse ($results as $index => $result)
                        <tr class="table-row">
                            <x-table.td>
                                <div x-on:click="openDropdown = {{ $index }}"
                                    class="items-center inline-flex justify-center relative rounded-full p-2 cursor-pointer">
                                    <svg focusable="false" aria-hidden="true" viewbox="0 0 24 24" fill="currentColor"
                                        class="h-4 w-4">
                                        <path d="M16.59 8.59 12 13.17 7.41 8.59 6 10l6 6 6-6z" fill="currentColor">
                                        </path>
                                    </svg>
                                </div>
                            </x-table.td>
                            <x-table.td>
                                {{ $result->participant->name }}
                            </x-table.td>
                            <x-table.td>
                                {{ $result->time }}
                            </x-table.td>
                            <x-table.td>
                                {{ $result->place }}
                            </x-table.td>
                            <x-table.td>
                                {{ Helpers::format_date($result->date) }}
                            </x-table.td>
                        </tr>
                        <tr x-show="openDropdown === {{ $index }}" class="bg-gray-50">
                            <td colspan="5" class="border-b px-10 text-sm pb-1 border-gray-200 border-solid">
                                <h3 class="text-xl text-center uppercase py-4">{{ __('Race Summary') }}</h3>

                                <div class="flex space-x-4 bg-white">
                                    <div
                                        class="flex-grow border-r flex flex-col py-1 px-3.5 border-neutral-200 border-solid">
                                        <p class="text-lg my-3">{{ $result->place }}</p>
                                        <p class="font-bold mb-2 uppercase">{{ __('Div Rank') }}</p>
                                    </div>
                                    <div class="flex-grow flex flex-col py-1 px-3.5">
                                        <p class="text-lg my-3">
                                            {{ !is_null($result->time) ? __('Finisher') : __('DNF') }}
                                        </p>
                                        <p class="font-bold mb-2 uppercase">{{ __('Designation') }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 my-2">
                                    <div class="py-2 bg-white shadow-md rounded-lg">
                                        <h4 class="text-center text-md font-bold my-4 uppercase">
                                            {{ __('Swim Details') }}
                                            {{-- {{ $this->calculateRank($result, 'swimming') }} --}}
                                        </h4>
                                        <div class="flex flex-col  overflow-hidden">
                                            <div class="py-2 text-md font-bold uppercase text-center">
                                                {{ __('Race Time') }}
                                            </div>
                                            <div class="py-2 text-md font-bold uppercase text-center">
                                                {{ $result->swimming }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 bg-white shadow-md rounded-lg">
                                        <h4 class="text-center text-md font-bold my-4 uppercase">
                                            {{ __('Run Details') }}
                                            {{-- {{ $this->calculateRank($result, 'running') }} --}}
                                        </h4>
                                        <div class="flex flex-col  overflow-hidden">
                                            <div class="py-2 text-md font-bold uppercase text-center">
                                                {{ __('Race Time') }}
                                            </div>
                                            <div class="py-2 text-md font-bold uppercase text-center">
                                                {{ $result->running }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-2 bg-white shadow-md rounded-lg ">
                                        <h4 class="text-center text-md font-bold my-4 uppercase">
                                            {{ __('Bike Details') }}
                                            {{-- {{ $this->calculateRank($result, 'cycling') }} --}}
                                        </h4>
                                        <div class="flex flex-col  overflow-hidden">
                                            <div class="py-2 text-md font-bold uppercase text-center">
                                                {{ __('Race Time') }}
                                            </div>
                                            <div class="py-2 text-md font-bold uppercase text-center">
                                                {{ $result->cycling }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-2 bg-white shadow-md rounded-lg ">
                                        <h4 class="text-center text-md font-bold my-4 uppercase">
                                            {{ __('Transition Details') }}
                                        </h4>
                                        <div class=" overflow-hidden">
                                            <div class="grid grid-cols-2 py-2 text-md font-bold uppercase">
                                                <div class="text-center">
                                                    {{ __('Transition 1') }}</div>
                                                <div class="text-center">{{ __('Transition 2') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-white  overflow-hidden">
                                            <div class="grid grid-cols-2 py-2 text-md font-bold uppercase">
                                                <div class="text-center">{{ $result->transition1 }}
                                                </div>
                                                <div class="text-center">{{ $result->transition2 }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border-b px-10 text-sm py-8 border-gray-200 border-solid">
                                {{ __('No results found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </x-table>

            <div class="pt-3">
                {{ $results->links() }}
            </div>
        @endif
    </div>
</div>
