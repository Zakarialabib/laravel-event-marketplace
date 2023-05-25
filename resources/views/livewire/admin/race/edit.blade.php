<div>
    <!-- Update Modal -->
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Update Race') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="update">
                <x-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="name" :value="__('Race Name')" required autofocus />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                wire:model.lazy="race.name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" for="name" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="number_of_days" :value="__('Number of days')" required />
                            <x-input id="number_of_days" class="block mt-1 w-full" type="number" name="number_of_days"
                                wire:model.lazy="race.number_of_days" required />
                            <x-input-error :messages="$errors->get('number_of_days')" for="number_of_days" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="number_of_racers" :value="__('Number of racers')" required />
                            <x-input id="number_of_racers" class="block mt-1 w-full" type="number" name="number_of_racers"
                                wire:model.lazy="race.number_of_racers" required />
                            <x-input-error :messages="$errors->get('number_of_racers')" for="number_of_racers" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="category_id" :value="__('Category')" required />
                            <select
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="category_id" name="category_id" wire:model.lazy="race.category_id">
                                <option value="" disabled>{{ __('Select Category') }}</option>
                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <x-input-error :messages="$errors->get('race.category_id')" for="race.category_id" class="mt-2" />
                            </select>
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="race_location_id" :value="__('Locations')" />
                            <select id="race_location_id" name="race_location_id"
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                wire:model.lazy="race.race_location_id">
                                <option value="" disabled>{{ __('Select Location') }}</option>
                                @foreach ($this->raceLocations as $racelocation)
                                    <option value="{{ $racelocation->id }}">{{ $racelocation->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('race.race_location_id')" for="race_location_id" class="mt-2" />
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="price" :value="__('Price')" required />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                wire:model.lazy="race.price" required />
                            <x-input-error :messages="$errors->get('price')" for="price" class="mt-2" />

                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="date" :value="__('Date')" required />
                            <x-input id="date" class="block mt-1 w-full" type="date" name="date"
                                wire:model.lazy="race.date" />
                            <x-input-error :messages="$errors->get('race.date')" for="date" class="mt-2" />

                        </div>

                        
                        <div class="w-full px-3 mb-6 lg:mb-0">
                            <x-label for="description" :value="__('Description')" />
                            {{-- <livewire:quill wire:model="description" /> --}}
                            <div wire:ignore>
                                <textarea id="description" wire:model.lazy="description"></textarea>
                            </div>
                        </div>

                        <div class="w-full px-4 my-2">
                            <x-label for="images" :value="__('Race Image')" />
                            <x-media-upload title="{{ __('Race Image') }}" name="images" wire:model="images" :file="$images"
                            multiple types="PNG / JPEG / WEBP" fileTypes="image/*" />
                        </div>

                    </div>

                    <x-accordion title="{{ __('More Details') }}">
                        <div class="flex flex-wrap px-4 mb-3">

                            {{-- <div class="w-full px-2">
                                <livewire:admin.race.social-medias />
                            </div>
                            <div class="w-full px-2">
                                <livewire:admin.race.features />
                            </div>
                            <div class="w-full px-2">
                                <livewire:admin.race.calendar />
                            </div>
                            <div class="w-full px-2">
                                <livewire:admin.race.sponsors />
                            </div>
                            <div class="w-full px-2">
                                <livewire:admin.race.courses />
                            </div> --}}
                            <div class="w-full px-2">
                                <livewire:admin.race.options />
                            </div>
                            
                            {{-- <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_title" :value="__('Meta Title')" />
                                <x-input id="meta_title" class="block mt-1 w-full" type="number" name="meta_title"
                                    wire:model.lazy="race.meta_title" />
                                <x-input-error :messages="$errors->get('meta_title')" for="meta_title" class="mt-2" />
                            </div>

                            <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_description" :value="__('Meta Description')" />
                                <x-input id="meta_description" class="block mt-1 w-full" type="number"
                                    name="meta_description" wire:model.lazy="race.meta_description" />
                                <x-input-error :messages="$errors->get('meta_description')" for="meta_description" class="mt-2" />
                            </div> --}}

                    </x-accordion>

                    <div class="w-full px-4 my-6">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>



@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                })

                Livewire.on('reinit', () => {
                    editor.setData('', '')
                })
            })
            .catch(error => {
                console.error(error);
            });

    </script>
@endpush