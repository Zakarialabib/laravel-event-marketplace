<div>
    <div class="relative mx-auto mb-5">
        <div class="w-full mx-auto bg-gray-900">
            @foreach ($this->sliders as $slider)
                <div class="flex flex-wrap -mx-4 py-10 px-4"
                    style="background-image: url({{ asset('images/sliders/' . $slider->photo) }});background-size: cover;background-position: center;">
                    <div class="w-full px-10 lg:mb-5 sm:mb-2">
                        <div class="lg:py-5 py-10 text-white px-2">
                            <h5 class="xl:text-2xl md:text-xl sm:text-md font-bold mb-2 cursor-pointer">
                                {{ $slider->subtitle }}
                            </h5>
                            <h2 class="xl:text-6xl md:text-2xl sm:text-xl font-semibold font-heading cursor-pointer">
                                {{ $slider->title }}
                            </h2>
                            <p class="py-10 xl:text-lg sm:text-sm">
                                {{-- <livewire:front.search-box /> --}}
                                @livewire('front.product-prices')
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      
     
        @if (count($this->sections) > 0)
            <div class="py-5 px-4 mx-auto bg-gray-100">
                <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                    @foreach ($this->sections as $section)
                        <div class="px-3 mb-6">
                            <div class="relative h-full text-center pt-16 bg-white">
                                <div class="pb-12 border-b">
                                    <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                                    @if ($section->subtitle)
                                        <p>{{ $section->subtitle }}</p>
                                    @endif
                                </div>
                                <div class="py-5 px-4 text-center">
                                    <p class="text-lg text-gray-500">
                                        {!! $section->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
