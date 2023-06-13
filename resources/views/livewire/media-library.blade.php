<div>
    <div class="px-6 pb-10">
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
                        <div class="relative" x-on:click="selectedImage = '{{ $media->getUrl() }}'">
                            <img src="{{ $media->getUrl() }}" alt="Media Image" class="w-full h-auto rounded">
                            <div class="absolute flex flex-row justify-between inset-x-0 bottom-0 bg-white p-2">
                                <div>
                                    <p class="text-xs text-gray-600">Related Model: {{ $media->model->name }}</p>
                                </div>
                                <button wire:click="deleteMedia('{{ $media->id }}')"
                                    class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div x-show="selectedImage" class="fixed h-auto max-w-lg mx-auto inset-x-0 top-10 flex justify-center z-50"
                @click.away="selectedImage = null">
                <div class="bg-black bg-opacity-75 p-4 rounded">
                    <button x-on:click="selectedImage = null" class="text-white px-2 py-1 my-2 float-right rounded">
                        X
                    </button>

                    <button x-on:click="editImage = null" class="text-white px-2 py-1 my-2 float-left rounded">
                        Edit
                    </button>

                    <img :src="selectedImage" id="image-preview" alt="Selected Image" class="w-full h-auto">

                    <button wire:click="cropImage" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Crop</button>
                </div>
            </div>
        </div>
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
                    @this.set('cropData', event.detail);
                }
            });
        });
    </script>
@endpush
