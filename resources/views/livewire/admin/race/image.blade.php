<div>
    <x-modal wire:model="imageModal">
        <x-slot name="title">
            {{ __('Image Management') }}
        </x-slot>
        <x-slot name="content">

            <x-validation-errors class="mb-4" :errors="$errors" />

            @if ($race)
                @foreach ($race->getMedia('images') as $image)
                    <img src="{{ $image->getUrl() }}" alt="Race Image">
                @endforeach
            @endif

            <form wire:submit.prevent="saveImage">
                <div class="flex flex-wrap">
                    <div class="w-full px-4 my-2">
                        {{-- import with url --}}
                        <x-label for="image" :value="__('Upload with url')" />
                        <x-input id="image_url" class="block mt-1 w-full" type="text" name="image_url"
                            wire:model="image_url" />
                    </div>

                    <div class="w-full px-4 my-2">
                        <x-label for="image" :value="__('Race Image')" />
                        <x-media-upload title="{{ __('Race Image') }}" name="images" wire:model="images"
                            :file="$images" multiple types="PNG / JPEG / WEBP" fileTypes="image/*" />
                    </div>

                    <div class="w-full px-4 my-4">
                        <x-button primary type="button" wire:click="saveImage" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
</div>
