<div>
    <div class="px-6 pb-10">
        <h3 class="text-lg font-bold">Media Library</h3>

        {{-- <div class="w-full flex flex-row gap-4">
            <div class="flex items-center mt-4">
                <label for="model" class="mr-2">Model:</label>
                <select id="model" wire:model="model" class="py-1 px-2 border border-gray-300 rounded">
                    @foreach ($models as $model => $modelName)
                        <option value="{{ $model }}">{{ $modelName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center mt-2">
                <label for="category" class="mr-2">Category:</label>
                <select id="category" wire:model="category" class="py-1 px-2 border border-gray-300 rounded">
                    <option value="">All</option>
                    @foreach ($categories as $categoryKey => $categoryName)
                        <option value="{{ $categoryKey }}">{{ $categoryName }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        @if ($this->model)
            <img src="{{ $this->model->getFirstMediaUrl('local_files') }}" alt="{{ $this->model->name }}"
                class="w-10 h-10 rounded-full object-cover">
        @else
            <p>No image available.</p>
        @endif
        <div x-data="{ selectedImage: null }">
            <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
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
            </div>

            <!-- Selected Image Display -->
            <div x-show="selectedImage" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-black bg-opacity-75 p-4 rounded">
                    <img :src="selectedImage" alt="Selected Image" class="w-full h-auto">
                    <button x-on:click="selectedImage = null"
                        class="bg-red-500 text-white px-2 py-1 rounded mt-2">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
