<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Category') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">

                <div class="w-full">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                        wire:model="category.name" />
                    <x-input-error :messages="$errors->get('category.name')" for="category.name" class="mt-2" />
                </div>

                <div class="w-full">
                    <x-label for="description" :value="__('Description')" />
                    <textarea id="description" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" name="description" rows="5"
                            wire:model="category.description"></textarea>
                    <x-input-error :messages="$errors->get('category.description')" for="category.description" class="mt-2" />
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
