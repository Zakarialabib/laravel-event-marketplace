<div>
    <div class="space-y-4 flex flex-col items-center justify-center my-4">
        @foreach ($options as $index => $option)
            <div class="flex flex-row w-full items-center space-x-4">
                <select wire:model="options.{{ $index }}.type"
                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                    <option value="">{{ __('Choose an option') }}</option>
                    <option value="color" {{ $option['type'] == 'color' ? 'selected' : '' }}>
                        {{ __('Color') }}
                    </option>
                    <option value="size" {{ $option['type'] == 'size' ? 'selected' : '' }}>{{ __('Size') }}
                    </option>
                </select>
                @if ($option['type'] === 'color')
                    <input type="color" wire:model="options.{{ $index }}.value">
                @else
                    <input type="text" wire:model="options.{{ $index }}.value">
                @endif
                <x-button danger type="button" wire:click="removeOption({{ $index }})">{{ __('Remove') }}
                </x-button>
            </div>
        @endforeach
        <x-button primary type="button" wire:click="addOption">{{ __('Add Option') }}</x-button>
    </div>
</div>
