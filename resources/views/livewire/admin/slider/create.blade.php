<div>
    <!-- Create Modal -->
    <x-modal wire:model="createSlider">
        <x-slot name="title">
            {{ __('Create Slider') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="flex flex-wrap space-y-2 px-2">

                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model="slider.title" />
                        <x-input-error :messages="$errors->get('slider.title')" for="slider.title" class="mt-2" />
                    </div>
                   
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="subtitle" :value="__('Subtitle')" />
                        <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle"
                            wire:model="slider.subtitle" />
                        <x-input-error :messages="$errors->get('slider.subtitle')" for="slider.subtitle" class="mt-2" />
                    </div>
                   
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="bg_color" :value="__('Background Color')" />
                        <x-input id="bg_color" class="block mt-1 w-full" type="color" name="bg_color"
                            wire:model="slider.bg_color" />
                        <x-input-error :messages="$errors->get('slider.bg_color')" for="slider.bg_color" class="mt-2" />
                    </div>

                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="link" :value="__('Link')" />
                        <x-input id="link" class="block mt-1 w-full" type="text" name="link"
                            wire:model="slider.link" />
                        <x-input-error :messages="$errors->get('slider.link')" for="slider.link" class="mt-2" />
                    </div>
                   
                    {{-- <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="label" :value="__('Label')" />
                        <x-input id="label" class="block mt-1 w-full" type="text" name="label"
                            wire:model="slider.label" />
                        <x-input-error :messages="$errors->get('slider.label')" for="slider.link" class="mt-2" />
                    </div> --}}
                    
                    <div class="xl:w-1/2 md:w-full px-2">
                        <x-label for="video" :value="__('Embeded Video')" />
                        <x-input id="embeded_video" class="block mt-1 w-full" type="text" name="embeded_video"
                            wire:model="slider.embeded_video" />
                        <x-input-error :messages="$errors->get('slider.embeded_video')" for="slider.link" class="mt-2" />
                    </div>

                    <div class="w-full px-2">
                        <x-label for="description" :value="__('Description')" />
                        <x-trix name="sliderDescription" wire:model="description" id="sliderDescription" />
                        <x-input-error :messages="$errors->get('description')" for="description" class="mt-2" />
                    </div>
                   

                    <div class="w-full py-2 px-3">
                        <x-label for="" :value="__('Image')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('')" for="" class="mt-2" />
                    </div>
                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
