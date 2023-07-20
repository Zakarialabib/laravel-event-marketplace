<div>
    @section('title', __('Home'))

    <x-topheader />

    <div class="relative mx-auto">
        <section class="w-full mx-auto bg-gray-900 h-screen relative">
            <x-theme.slider :sliders="$this->sliders" />
        </section>
        <section class="lg:px-10 sm:px-6 lg:py-16 md:py-14">
            <h3 
                class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tight font-extrabold text-black cursor-pointer pb-10 text-center">
                {{ __('Upcoming Races') }}
            </h3>
            <div class="flex flex-wrap items-center mt-4 space-y-4">
                @forelse ($this->races as $race)
                    <div class="relative w-full px-4">
                        <x-race-card :race="$race" view="wide" />
                    </div>
                @empty
                    <div class="w-full bg-gray-50 py-10 mb-10 rounded-lg px-4 md:-mx-4 shadow-2xl">
                        <h3 class="text-3xl text-center font-bold font-heading text-blue-900">
                            {{ __('No Races found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="h-auto bg-gray-50 text-black md:px-4 lg:px-10 py-4 md:py-6 lg:py-10">
            <h5
                class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tight font-extrabold text-black cursor-pointer pb-10 text-center">
                {{ __('Races Locations') }}
            </h5>
            <hr>
            <div class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 gap-6 mt-4 px-5">
                @foreach ($this->raceLocations as $raceLocation)
                    <div class="float-left mx-3">
                        <figure class="text-gray-700 flex break-words">
                            <div
                                class="items-center clear-both flex flex-col float-left justify-start my-3.5 pb-8 text-center">
                                <div class="float-left mb-3 w-full">
                                    <img src="{{ $raceLocation->getFirstMediaUrl('local_files') }}"
                                        class="h-96 w-full transition-all duration-300">
                                    <ul
                                        class="flex flex-col bg-red-600 text-white cursor-pointer py-5 px-8 gap-y-2 text-center">
                                        <li class="text-lg font-bold">
                                            {{ $raceLocation->name }}
                                        </li>
                                        <li class="text-md tracking-tighter">
                                            {!! $raceLocation->description !!}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="w-full bg-green-50 py-12 lg:ml-auto bg-opacity-80">
            <h3 class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tight font-extrabold text-black cursor-pointer pb-10 text-center">
                {{ __('Sponsors') }}
            </h3>
            <div class="flex flex-wrap items-center justify-center -mx-2 -mb-12 gap-x-6">
                @foreach ($this->sponsors as $sponsor)
                    <div class="w-1/4 sm:w-1/2 md:w-1/3 lg:w-1/6 px-2 mb-12">
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

        @livewire('front.resources')

        @if (count($this->featuredProducts) > 0)
            <section class="py-10 mx-auto px-4 text-center text-black">
                <h2
                    class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl md:leading-normal leading-normal font-bold cursor-pointer pb-10 text-center">
                    <a href="{{ route('front.catalog') }}">
                        {{ __('Visit Store') }}
                    </a>
                </h2>

                <p class="text-center mb-6">
                    {{ __('We have a wide range of products for you to choose from') }}
                </p>

                <hr>
                <div class="relative mb-6">
                    <x-product-slider :products="$this->featuredProducts" />
                </div>
            </section>
        @endif


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
</div>
