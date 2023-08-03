<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Blog Category') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="flex flex-wrap space-y-2 px-2">
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model="blogcategory.title" />
                        <x-input-error :messages="$errors->get('blogcategory.title')" for="blogcategory.title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="language_id" :value="__('Language')" required />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            required
                            id="language_id" name="language_id" wire:model="blogcategory.language_id">
                            <option value="">{{ __('Select Language') }}</option>
                            @foreach ($this->languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('blog.language_id')" for="blog.language_id" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="meta_title" :value="__('Meta Tag')" />
                        <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                            wire:model="blogcategory.meta_title" />
                        <x-input-error :messages="$errors->get('blogcategory.meta_title')" for="blogcategory.meta_title" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="meta_description" :value="__('Meta Description')" />
                        <x-input id="meta_description" class="block mt-1 w-full" type="text" name="meta_description"
                            wire:model="blogcategory.meta_description" />
                        <x-input-error :messages="$errors->get('blogcategory.meta_description')" for="blogcategory.meta_description" class="mt-2" />
                    </div>

                    <div class="w-full px-2">
                        <x-label for="description" :value="__('Description')" />
                        <textarea id="description" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" name="description" rows="5"
                            wire:model="blogcategory.description"></textarea>
                        <x-input-error :messages="$errors->get('blogcategory.description')" for="blogcategory.description" class="mt-2" />
                    </div>
                    <div class="w-full px-2">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
