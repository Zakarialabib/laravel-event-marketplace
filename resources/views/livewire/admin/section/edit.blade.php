<div>
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Section') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form enctype="multipart/form-data" wire:submit.prevent="update">
                <div class="flex flex-wrap space-y-2 px-2">
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="language_id" :value="__('Language')" />
                        <select
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="language_id" name="language_id" wire:model="section.language_id">
                            <option value="" selected>{{ __('Select a Language') }}</option>
                            @foreach ($this->languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('section.language_id')" for="section.language_id" class="mt-2" />
                    </div>

                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="page" :value="__('Page')" />
                        <select wire:model="section.page"
                            class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500  lang"
                            name="page">
                            <option value="" selected>{{ __('Select a Page') }}</option>
                            @foreach (\App\Enums\PageType::values() as $value => $name)
                                <option value="{{ $value }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('section.page')" for="section.page" class="mt-2" />
                    </div>

                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="title" :value="__('Title')" />
                        <x-input type="text" name="title" wire:model="section.title" />
                        <x-input-error :messages="$errors->get('section.title')" for="section.title" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="featured_title" :value="__('Featured title')" />
                        <x-input type="text" name="featured_title" wire:model="section.featured_title"
                            placeholder="{{ __('featured_title') }}" value="{{ old('featured_title') }}" />
                        <x-input-error :messages="$errors->get('section.featured_title')" for="section.featured_title" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="subtitle" :value="__('Subtitle')" />
                        <x-input type="text" name="subtitle" wire:model="section.subtitle"
                            placeholder="{{ __('Subtitle') }}" value="{{ old('subtitle') }}" />
                        <x-input-error :messages="$errors->get('section.subtitle')" for="section.subtitle" class="mt-2" />
                    </div>
                   
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="bg_color" :value="__('Background color')" />
                        <input wire:model="section.bg_color" id="bg_color" type="color">
                        <x-input-error :messages="$errors->get('section.bg_color')" for="section.bg_color" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="label" :value="__('Label')" />
                        <x-input wire:model="section.label" id="label" type="text" />
                        <x-input-error :messages="$errors->get('section.label')" for="section.label" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="link" :value="__('Link')" />
                        <x-input wire:model="section.link" id="link" type="url" />
                        <x-input-error :messages="$errors->get('section.link')" for="section.link" class="mt-2" />
                    </div>
                    <div class="lg:w-1/2 sm:w-full px-2">
                        <x-label for="position" :value="__('Position')" />
                        <x-input wire:model="section.position" id="position" type="number" />
                        <x-input-error :messages="$errors->get('section.position')" for="section.position" class="mt-2" />
                    </div>

                    <div class="w-full px-2">
                        <x-label for="description" :value="__('Description')" />
                        <x-trix name="description" wire:model="description" />
                        <x-input-error :messages="$errors->get('description')" for="description" class="mt-2" />
                    </div>
                    <div class="w-full px-2">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('section.image')" for="section.image" class="mt-2" />
                    </div>
                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
