<div>
    <div class="relative mx-auto mb-5">
        <section class="w-full mx-auto bg-gray-900">
            @foreach ($this->sliders as $slider)
                <div class="relative">
                    <div class="absolute inset-0 bg-black opacity-75" style="background-color:{{ $slider->bg_color }}">
                    </div>
                    <div class="flex flex-wrap -mx-4 py-20 px-4"
                        style="background-image: url({{ $slider->getFirstMediaUrl('local_files') }});background-size: cover;background-position: center;">
                        <div class="w-full px-10 lg:mb-5 sm:mb-2 z-50">
                            <div class="lg:py-5 py-10 text-white px-2">
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
                </div>
            @endforeach
        </section>
        <section class="pb-24 pt-10 px-10 bg-redBrick-600">
            <h3
                class="xl:text-5xl md:text-2xl sm:text-lg text-white hover:text-redBrick-500 uppercase text-center font-bold mb-2 cursor-pointer py-10">
                {{ __('Upcoming Races') }}
            </h3>
            <div class="w-full mb-10 px-6 space-y-10">
                @forelse ($this->races as $race)
                    <div
                        class="flex flex-wrap items-center bg-gray-50 rounded-lg w-full border-2 border-redBrick-800 transition duration-300 ease-in-out delay-200 transform shadow-2xl md:hover:translate-x-0 md:hover:translate-y-8">
                        <div class="w-full lg:w-1/2 flex items-center md:items-start relative h-72 lg:h-96"
                            style="background-image: url({{ $race->getFirstMediaUrl('local_files') }});background-size: cover;background-position: center;">
                            <div class="absolute top-0 left-0 p-4 bg-redBrick-600 text-white text-center shadow-xl rounded-br-xl 
                                "><p class="font-medium leading-leading-tight">
                                    {{ \Carbon\Carbon::parse($race->date)->format('F') }}</p>
                                <p class="font-extrabold text-2xl leading-tight">
                                    {{ \Carbon\Carbon::parse($race->date)->format('d') }}</p>
                                <p class="leading-tight">{{ \Carbon\Carbon::parse($race->date)->format('Y') }}</p>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 py-10 relative">
                            <div class="px-4 text-center">
                                <a class="block mb-4 text-2xl leading-6 text-gray-800 hover:text-gray-900 font-bold hover:underline"
                                    href="{{ route('front.raceDetails', $race->slug) }}">
                                    {{ $race->name }}
                                </a>
                                <div class="flex flex-wrap py-4 gap-8 justify-center items-center">
                                    <p class="flex items-center">
                                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <span class="text-base md:text-lg">{{ $race->location->name }}</span>
                                    </p>
                                    <p class="flex items-center">
                                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                            <i class="fas fa-tags"></i>
                                        </span>
                                        <span class="text-base md:text-lg">{{ $race->category->name }}</span>
                                    </p>
                                    <p class="flex items-center">
                                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <span class="text-base md:text-lg">{{ $race->number_of_days }}
                                            {{ __('days') }}</span>
                                    </p>
                                    <p class="flex items-center">
                                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <span class="text-base md:text-lg">{{ $race->number_of_racers }}</span>
                                    </p>
                                    <p class="flex items-center">
                                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </span>
                                        <span class="text-base md:text-lg">{{ $race->price }} DH</span>
                                    </p>
                                    @if ($race->course)
                                        <p class="flex items-center">
                                        <ul>
                                            @foreach (json_decode($race->course) as $key => $course)
                                                <li class="text-base inline-flex gap-2 md:text-lg">
                                                    <span
                                                        class="text-xs uppercase px-[10px] py-[5px] tracking-widest whitespace-nowrap inline-block rounded-md bg-redBrick-500 hover:bg-redBrick-800 text-white">
                                                        {{ ucfirst($key) }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    @else
                                        <p class="block text-base md:text-lg text-gray-400">No course details available.
                                        </p>
                                    @endif
                                    <div class="py-2 flex w-full">
                                        <a href="{{ route('front.raceDetails', $race->slug) }}"
                                            class="bottom-0 w-full text-center cursor-pointer bg-redBrick-600 py-4 px-2 text-lg front-bold text-white hover:bg-redBrick-800 hover:text-redBrick-100 focus:bg-redBrick-800 font-semibold uppercase">
                                            {{ __('Check race') }}
                                        </a>
                                    </div>
                                </div>

                                {{-- @if ($race->social_media)
                                    <p class="mb-4">
                                        <x-theme.social-media-icons :socialMedia="$race->social_media" />
                                    </p>
                                @else
                                    <p class="block text-base md:text-lg text-gray-400">
                                        {{ __('No social media available') }}.
                                    </p>
                                @endif --}}


                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-50 py-10 mb-10 rounded-lg w-full px-4 md:-mx-4 shadow-2xl">
                        <h3 class="text-3xl text-center font-bold font-heading text-blue-900">
                            {{ __('No Races found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="h-auto bg-gray-100 text-black px-10 py-10 ">
            <h5 class="xl:text-3xl md:text-xl sm:text-lg uppercase pb-4 text-center font-bold mb-2 cursor-pointer">
                {{ __('Races Locations') }}
            </h5>
            <hr>
            <div class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 gap-6 mt-4">
                @foreach ($this->raceLocations as $raceLocation)
                    <div
                        class="flex flex-col h-max justify-between items-center rounded-xl bg-gray-50 shadow-xl transition duration-300 ease-in-out delay-200 transform  md:hover:translate-x-0 md:hover:-translate-y-4">
                        <img class="opacity-75 rounded w-full h-auto"
                            src="{{ $raceLocation->getFirstMediaUrl('local_files') }}" />
                        <p
                            class="relative z-50 xl:text-xl md:text-lg font-semibold text-center py-4 tracking-tight text-black px-4">
                            {{ $raceLocation->name }}
                        </p>
                        <p class="relative w-full text-lg sm:text-sm z-50 font-medium text-center py-4 px-2 text-black">
                            {{ $raceLocation->description }}
                        </p>
                    </div>
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
