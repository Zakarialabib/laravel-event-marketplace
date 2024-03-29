<div>
    <!-- Edit Modal -->
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Resource') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />
            <form wire:submit.prevent="update">
                <div class="flex flex-wrap -mx-3 space-y-0">
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="title" :value="__('Name')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" required
                            wire:model="blog.title" />
                        <x-input-error :messages="$errors->get('blog.title')" for="blog.title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="slug" :value="__('Slug')" />
                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" disabled
                            wire:model="blog.slug" />
                        <x-input-error :messages="$errors->get('blog.slug')" for="blog.slug" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="category_id" :value="__('Category')" required />
                        <select required
                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="category_id" name="category_id" wire:model="blog.category_id">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('blog.category_id')" for="blog.category_id" class="mt-2" />
                    </div>

                    <div class="w-full px-3 mb-4">
                        <x-label for="description" :value="__('Description')" required />
                        @livewire('editorjs', [
                            'editorId' => 'myEditor1',
                            'value' => $description,
                            'readOnly' => false,
                            'class' => 'border w-full h-auto',
                            'placeholder' => 'Lorem ipsum dolor sit amet',
                        ])
                    </div>
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="meta_title" :value="__('Meta title')" />
                        <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                            wire:model="blog.meta_title" />
                        <x-input-error :messages="$errors->get('blog.meta_title')" for="blog.meta_title" class="mt-2" />
                    </div>
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="meta_description" :value="__('Meta description')" />
                        <x-input id="meta_description" class="block mt-1 w-full" type="text" name="meta_description"
                            wire:model="blog.meta_description" />
                        <x-input-error :messages="$errors->get('blog.meta_description')" for="blog.meta_description" class="mt-2" />
                    </div>
                    <div class="w-full py-2 px-3">
                        <x-label for="image" :value="__('Image')" />
                        <x-fileupload wire:model="images" :file="$images" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>
                    <div class="w-full px-3">
                        <x-button primary type="submit" class="w-full" wire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
