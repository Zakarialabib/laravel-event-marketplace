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
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-wrap items-center -mx-4 mb-12 md:mb-16">
            @foreach ($this->races as $race)
                <div class="flex flex-wrap items-center w-full px-4 mb-8 md:-mx-4">
                    <div class="w-full md:w-auto md:px-4">
                        <a class="inline-block mb-6 md:mb-0 overflow-hidden rounded-md" href="#">
                            <img src="flex-ui-assets/images/blog/effect3.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-full md:flex-1 md:px-4">
                        <a class="inline-block mb-4 text-2xl leading-tight text-coolGray-800 hover:text-coolGray-900 font-bold hover:underline"
                            href="{{ route() }}">{{ $race->name }}</a>
                        <p class="mb-7 text-base md:text-lg text-coolGray-400 font-medium">{{ $race->description }}</p>
                        <a class="inline-flex items-center text-base md:text-lg text-green-500 hover:text-green-600 font-semibold"
                            href="{{ route() }}">
                            <span class="mr-3">{{ __('Check race') }}</span>
                            <svg width="8" height="10" viewbox="0 0 8 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.94667 4.74665C7.91494 4.66481 7.86736 4.59005 7.80666 4.52665L4.47333 1.19331C4.41117 1.13116 4.33738 1.08185 4.25617 1.04821C4.17495 1.01457 4.08791 0.997253 4 0.997253C3.82246 0.997253 3.6522 1.06778 3.52667 1.19331C3.46451 1.25547 3.4152 1.32927 3.38156 1.41048C3.34792 1.4917 3.33061 1.57874 3.33061 1.66665C3.33061 1.84418 3.40113 2.01445 3.52667 2.13998L5.72667 4.33331H0.666667C0.489856 4.33331 0.320286 4.40355 0.195262 4.52858C0.070238 4.6536 0 4.82317 0 4.99998C0 5.17679 0.070238 5.34636 0.195262 5.47138C0.320286 5.59641 0.489856 5.66665 0.666667 5.66665H5.72667L3.52667 7.85998C3.46418 7.92196 3.41458 7.99569 3.38074 8.07693C3.34689 8.15817 3.32947 8.24531 3.32947 8.33331C3.32947 8.42132 3.34689 8.50846 3.38074 8.5897C3.41458 8.67094 3.46418 8.74467 3.52667 8.80665C3.58864 8.86913 3.66238 8.91873 3.74361 8.95257C3.82485 8.98642 3.91199 9.00385 4 9.00385C4.08801 9.00385 4.17514 8.98642 4.25638 8.95257C4.33762 8.91873 4.41136 8.86913 4.47333 8.80665L7.80666 5.47331C7.86736 5.40991 7.91494 5.33515 7.94667 5.25331C8.01334 5.09101 8.01334 4.90895 7.94667 4.74665Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @foreach ($this->receLocations as $raceLocation)
            {{ $raceLocation->name }}
        @endforeach
        @foreach ($this->sponsors as $sponsor)
            {{ $sponsor->name }}
        @endforeach


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
