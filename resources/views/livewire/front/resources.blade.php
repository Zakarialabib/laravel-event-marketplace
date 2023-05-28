<div>
    @if (count($this->resources) > 0)
    <div class="bg-gray-200 py-10 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">{{ __('Resources') }}</h2>
            <hr>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Resource Card -->
                @foreach ($this->resources as $resource)
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <img src="path/to/resource-image.jpg" alt="Resource Image" class="w-full mb-4">
                        <h3 class="text-xl font-semibold mb-2">{{ $resource->name }}</h3>
                        <p class="text-gray-700 mb-4">
                            {{ $resource->description }}
                        </p>
                        <a href="#" class="text-blue-600 font-semibold hover:underline">{{__('Read More')}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
