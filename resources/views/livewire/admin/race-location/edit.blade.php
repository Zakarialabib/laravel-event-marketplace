<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit RaceLocation') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="grid grid-cols-2 gap-2">
                    <div class="w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model="raceLocation.name" />
                        <x-input-error :messages="$errors->get('raceLocation.name')" for="raceLocation.name" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="category_id" :value="__('Category')" required />
                        <select
                            class="block mt-1 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="category_id" name="category_id" wire:model="raceLocation.category_id">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($this->categories as $category)
                                <option value="{{ $category->id }}" @if ($raceLocation?->category_id == $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                            <x-input-error :messages="$errors->get('raceLocation.category_id')" for="raceLocation.category_id" class="mt-2" />
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <x-label for="description" :value="__('Description')" />
                    <textarea id="description" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" name="description" rows="5"
                            wire:model="raceLocation.description"></textarea>
                    <x-input-error :messages="$errors->get('raceLocation.description')" for="raceLocation.description" class="mt-2" />
                </div>

                <div class="w-full my-2">
                    <x-label for="image" :value="__('Image')" />
                    <x-media-upload title="{{ __('Image') }}" name="image" wire:model="image" :file="$image"
                        single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                </div>

                <div class="w-full">
                    <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
