<div>
    <x-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Show Race') }} - {{ $race?->name }}
        </x-slot>

        <x-slot name="content">
            <div class="px-4 mx-auto mb-4">
                <div class="w-full mb-3">
                    <div class="flex justify-center px-3">
                        <img src="{{ $race?->getFirstMediaUrl('races') }}" alt="{{ $race?->name }}"
                            class="w-32 h-32 rounded-full">
                    </div>
                </div>
                <div class="flex flex-row">
                    <div class="w-full px-4">
                        <x-table-responsive>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Slug') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $race?->slug }}
                                </x-table.td>
                            </x-table.tr>

                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Name') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $race?->name }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Category') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $race?->category?->name }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Location') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ $race?->location?->name }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Date') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ formatDate($race?->start_registration) }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Date') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ formatDate($race?->end_registration) }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Date') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ formatDate($race?->registration_deadline) }}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Price') }}
                                </x-table.th>
                                <x-table.td>
                                    {{ formatCurrency($race?->price) }}
                                </x-table.td>
                            </x-table.tr>

                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Description') }}
                                </x-table.th>
                                <x-table.td class="whitespace-pre-line">
                                    {!! $race?->description !!}
                                </x-table.td>
                            </x-table.tr>
                            <x-table.tr>
                                <x-table.th>
                                    {{ __('Images') }}
                                </x-table.th>
                                <x-table.td>
                                    <div class="flex gap-4">
                                        @foreach ($race?->getMedia('local_files') as $image)
                                            <img src="{{ $image->getUrl() }}" alt="{{ $image->getUrl() }}"
                                                class="rounded shadow w-28 h-28">
                                        @endforeach
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                        </x-table-responsive>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-modal>
</div>
