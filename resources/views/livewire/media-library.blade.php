<div>
    <div class="px-6 py-10">
        <h3 class="text-lg font-bold">Media Library</h3>

        <div class="mb-4">
            <label for="model" class="mr-2">Select Model:</label>
            <select wire:model="model" id="model" class="p-2 border rounded">
                <option value="">All</option>
                @foreach ($models as $modelName)
                    <option value="{{ $modelName }}">{{ $modelName }}</option>
                @endforeach
            </select>
        </div>
        <div x-data="{ selectedImage: null }">
            <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @if ($mediaItems)
                    @foreach ($mediaItems as $media)
                        <div class="relative">
                            <img src="{{ $media->getUrl() }}" alt="Media Image" class="w-full h-auto rounded"
                                x-on:click="selectedImage = '{{ $media->getUrl() }}'">
                            <div class="absolute flex flex-row justify-between inset-x-0 bottom-0 bg-white p-2">
                                <div>
                                    <p class="text-xs text-gray-600">Related Model: {{ $media->model->name }}</p>
                                </div>
                                <div class="flex flex-row">
                                    <button wire:click="editMedia('{{ $media->id }}')"
                                        class="bg-blue-500 text-white px-2 py-1 rounded mr-2">Edit</button>
                                    <button wire:click="deleteMedia('{{ $media->id }}')"
                                        class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div x-show="selectedImage" class="fixed h-auto max-w-lg mx-auto inset-x-0 top-10 flex justify-center z-50"
                @click.away="selectedImage = null">
                <div class="bg-white p-4 rounded">
                    <button x-on:click="selectedImage = null" class="text-gray-600 px-2 py-1 my-2 float-right rounded">
                        X
                    </button>

                    <div class="flex flex-row justify-between items-center">
                        <img :src="selectedImage" id="image-preview" alt="Selected Image" class="w-full h-auto">
                        <div class="flex flex-col items-center">
                            <button wire:click="cropImage"
                                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Crop</button>
                            <button wire:click="editImage"
                                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <x-modal wire:model="editModal">
                <x-slot name="title">
                    Edit Media
                </x-slot>

                <x-slot name="content">
                    <div class="w-full px-2">
                        <label for="image-preview">Image Preview:</label>
                        {{-- <img id="image-preview" src="{{ $media?->getUrl() }}" alt="{{ $media->name }}"> --}}
                    </div>
                    <div class="grid grid-cols-4 gap-4 py-4">
                        <p>
                            <label for="crop-x">Crop X:</label>
                            <x-input type="number" id="crop-x" wire:model.lazy="cropData.x" />
                        </p>
                        <p>
                            <label for="crop-y">Crop Y:</label>
                            <x-input type="number" id="crop-y" wire:model.lazy="cropData.y" />
                        </p>
                        <p>
                            <label for="crop-width">Crop Width:</label>
                            <x-input type="number" id="crop-width" wire:model.lazy="cropData.width" />
                        </p>
                        <p>
                            <label for="crop-height">Crop Height:</label>
                            <x-input type="number" id="crop-height" wire:model.lazy="cropData.height" />
                        </p>
                    </div>
                    <div class="w-full">
                        <x-button type="button" secondary wire:click="$set('editModal', false)">Cancel</x-button>
                        <x-button type="button" primary wire:click="cropImage">Crop Image</x-button>
                    </div>
                </x-slot>
            </x-modal>
        </div>
    </div>


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                const image = document.getElementById('image-preview');
                const cropper = new Cropper(image, {
                    viewMode: 1,
                    autoCropArea: 1,
                    crop: function(event) {
                        @this.set('cropData', {
                            x: event.detail.x,
                            y: event.detail.y,
                            width: event.detail.width,
                            height: event.detail.height,
                        });
                    },
                });
            });
        </script>
    @endpush
</div>
