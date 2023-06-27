<div>
    @section('title', __('Home'))

    <x-topheader />
    
    <div class="relative mx-auto mb-5">
        <section class="w-full mx-auto bg-gray-900 h-screen relative">
            @foreach ($this->sliders as $slider)
                <div class="relative h-screen flex items-center justify-center">
                    <div class="absolute inset-0 bg-black opacity-75" 
                        style="background-image: url({{ $slider->getFirstMediaUrl('local_files') }});background-size: cover;background-position: center;background-color:{{ $slider->bg_color }}">
                    </div>
                    <div class="max-w-3xl w-full py-10 px-6 mb-5 sm:mb-2 z-20">
                        <div class="lg:py-5 py-10 text-white px-8">
                            <h5 class="xl:text-2xl md:text-xl sm:text-md font-bold mb-2">
                                {{ $slider->subtitle }}
                            </h5>
                            <h2
                                class="max-w-5xl text-2xl font-bold leading-none tracking-tighter text-neutral-600 md:text-5xl lg:text-6xl lg:max-w-7xl">
                                {{ $slider->title }}
                            </h2>
                            <p class="text-md font-medium my-4">
                                {{ $slider->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
        <section class="px-10 md:py-14 lg:py-16 xl:py-[75px] bg-redBrick-600">
            <h3
                class="xl:text-5xl md:text-2xl sm:text-lg text-white hover:text-redBrick-500 uppercase text-center font-bold mb-2 cursor-pointer py-10">
                {{ __('Upcoming Races') }}
            </h3>
            <div class="w-full mb-10 px-6 space-y-10">
                @forelse ($this->races as $race)
                    <x-race-card :race="$race" view="list" />
                @empty
                    <div class="bg-gray-50 py-10 mb-10 rounded-lg w-full px-4 md:-mx-4 shadow-2xl">
                        <h3 class="text-3xl text-center font-bold font-heading text-blue-900">
                            {{ __('No Races found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="h-auto bg-gray-100 text-black px-10 md:py-14 lg:py-16 xl:py-[75px]">
            <h5 class="xl:text-3xl md:text-xl sm:text-lg uppercase pb-4 text-center font-bold mb-2 cursor-pointer">
                {{ __('Races Locations') }}
            </h5>
            <hr>
            <div class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 gap-6 mt-4">
                @foreach ($this->raceLocations as $raceLocation)
                    <figure
                        class="shadow-xl transition duration-300 ease-in-out delay-200 transform  md:hover:translate-x-0 md:hover:-translate-y-4 mb-6">
                        <div class="glightbox group relative block h-full overflow-hidden bg-gray-200 text-center">
                            <img class="aspect-video w-full object-cover transition-all duration-300 group-hover:scale-110 group-hover:opacity-75"
                                src="{{ $raceLocation->getFirstMediaUrl('local_files') }}" />
                            <h3
                                class="py-4 font-bold leading-tight text-primary dark:text-white lg:text-lg lg:leading-6">
                                {{ $raceLocation->name }}
                            </h3>

                            <p class="text-sm leading-tight tracking-tighter text-center py-6">
                                {!! $raceLocation->description !!}
                            </p>
                        </div>
                    </figure>
                @endforeach
            </div>
        </section>

        @livewire('front.resources')

        @if (count($this->featuredProducts) > 0)
            <section class="bg-gray-900 py-10 mx-auto px-4 text-center text-white">
                <h2 class="text-3xl font-bold mb-8 text-gray-100">
                    <a href="https://www.example-store.com" target="_blank" rel="noopener">
                        {{ __('Visit Store') }}
                    </a>
                </h2>

                <p class="text-center mb-6">Gear up for success! Visit our online store to explore a
                    wide
                    range of high-quality products designed for endurance athletes.</p>

                <hr>
                <div class="mt-10 px-4">
                    {{-- <h3 class="text-2xl font-semibold mb-6 text-gray-100">{{ __('Featured Products') }}</h3> --}}

                    <div class="Swiper mySwiper relative w-full h-auto">
                        <div class="swiper-wrapper">
                            @foreach ($this->featuredProducts as $product)
                                <div class="swiper-slide">
                                    <x-product-card :product="$product" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
        @endif

        <section class="px-5 py-12 lg:px-16 bg-gray-50">
            <h5 class="xl:text-3xl md:text-xl sm:text-lg uppercase pb-4 text-center font-bold mb-2 cursor-pointer">
                {{ __('Sponsors') }}
            </h5>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 justify-center">
                @foreach ($this->sponsors as $sponsor)
                    <div class="py-4 relative rounded-xl">
                        <img class="mx-auto w-56 h-auto my-4 filter grayscale transition duration-300 hover:grayscale-0"
                            src="{{ $sponsor->getFirstMediaUrl('local_files') }}" alt="{{ $sponsor->name }}">
                        <p
                            class="text-center text-sm px-4 mb-4 absolute bottom-0 left-0 w-full text-white text-opacity-0 group-hover:text-opacity-100 transition-opacity duration-300 cursor-pointer">
                            {{ $sponsor->name }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>
        @if (count($this->sections) > 0)
            <section class="py-5 px-4 mx-auto bg-gray-100">
                <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                    @foreach ($this->sections as $section)
                        <div class="px-3 mb-6 relative h-full text-center pt-16 bg-white">
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
                    @endforeach
                </div>
            </section>
        @endif
    </div>
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {

                var swiper = new Swiper('.mySwiper', {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    loop: true,
                    grabCursor: true,
                    breakpoints: {
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        640: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 40,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 50,
                        },
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        type: 'bullets',
                        clickable: true,
                    },
                });

            });
        </script>
    @endpush
</div>
