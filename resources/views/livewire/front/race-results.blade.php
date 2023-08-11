<div>
    <div class="relative flex flex-col p-8 shadow-sm rounded-2xl border-skin-base bg-skin-card/50 backdrop-blur-sm">
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
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500 block w-32 ">
                    @foreach ($paginationOptions as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model.debounce.300ms="search"
                    class="p-3 leading-5 bg-white text-gray-500 rounded border border-gray-300 mb-1 text-sm block focus:shadow-outline-blue focus:border-blue-500"
                    placeholder="{{ __('Search') }}" />
            </div>

            <x-table>
                <x-slot name="thead">
                    <x-table.th>
                        {{ __('Participant name') }}
                        @include('components.table.sort', ['field' => 'participant_id'])
                    </x-table.th>
                    <x-table.th>
                        {{ __('Time') }}
                        @include('components.table.sort', ['field' => 'time'])
                    </x-table.th>
                    <x-table.th>
                        {{ __('Place') }}
                        @include('components.table.sort', ['field' => 'place'])
                    </x-table.th>
                    <x-table.th>
                        {{ __('Date') }}
                        @include('components.table.sort', ['field' => 'date'])
                    </x-table.th>
                </x-slot>
                <x-table.tbody>
                    @foreach ($results as $result)
                        <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $result->id }}">
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
                                {{ $result->date }}
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>

            <div class="pt-3">
                {{ $results->links() }}
            </div>

        @endif
    </div>
</div>
