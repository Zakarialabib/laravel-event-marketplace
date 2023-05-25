<div>
    <div class="pb-24 pt-10 px-10" x-data="{ showRegistrationForm: false }">
        <div class="flex justify-center items-center h-full">
            <img class="object-cover object-center w-full h-full rounded-xl md:h-36 lg:h-full lg:object-top"
                src="{{ $race->getFirstMediaUrl('local_files') }}" alt="{{ $race->name }}">
        </div>

        <h3 class="xl:text-5xl md:text-2xl sm:text-lg uppercase py-6 text-center font-bold mb-2 py-10">
            {{ $race->name }} - {{ $race->category->name }}
        </h3>

        <p class="mb-4 text-center leading-6 text-2xl text-gray-800 hover:text-gray-900 font-bold">
            {{ $race->date }}
        </p>

        <div class="w-full px-4 mx-auto">
            <div x-data="{ activeTab: '' }">
                <div class="grid gap-4 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 mb-10 ">
                    @php
                        $courseData = json_decode($race->course, true);
                        $categoryName = strtolower($race->category->name);
                    @endphp

                    @if ($courseData)
                        @foreach ($courseData as $key => $course)
                            @if ($categoryName == $key || $categoryName == 'triathlon')
                                <div class="w-full">
                                    <button
                                        class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold text-white bg-red-600 uppercase border-b-2 border-red-100 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                                        type="button" @click="activeTab = '{{ $key }}'"
                                        :class="{
                                            'border-red-200': '{{ $key }}',
                                            'text-red-200': '{{ $key }}',
                                            'hover:text-red-200': '{{ $key }}',
                                        }">
                                        <h4 class="inline-block" :class="{ 'text-white-200': '{{ $key }}' }">
                                            {{ ucfirst($key) }}
                                        </h4>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                @if ($courseData)
                    <div class="">
                        @foreach ($courseData as $key => $course)
                            <div x-show="activeTab === '{{ $key }}'" class="py-10 bg-gray-100 px-4">
                                <div role="{{ $key }}" id="tab-panel-{{ $loop->index }}"
                                    class="w-full mb-4">
                                    <div class="flex flex-col justify-center space-y-2">
                                        <p class="leading-6 text-base md:text-lg">{{ $course['content'] }}</p>
                                        <x-button secondary type="button">download</x-button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="flex flex-wrap items-center bg-gray-50 rounded-lg w-full ">
                <div class="w-full text-center mb-5">
                    <p class="mb-7 text-base md:text-lg text-gray-400 font-medium">{{ $race->description }}</p>

                    <div class="mb-4">
                        <span class="text-sm md:text-base font-medium text-gray-500">{{ __('Race Location') }}:</span>
                        <span class="text-base md:text-lg">{{ $race?->location->name }}</span>
                    </div>

                    <div class="mb-4">
                        <span class="text-sm md:text-base font-medium text-gray-500">{{ __('Number of Days') }}:</span>
                        <span class="text-base md:text-lg">{{ $race->number_of_days }}</span>
                    </div>

                    <div class="mb-4">
                        <span
                            class="text-sm md:text-base font-medium text-gray-500">{{ __('Number of Racers') }}:</span>
                        <span class="text-base md:text-lg">{{ $race->number_of_racers }}</span>
                    </div>

                    <div class="mb-4">
                        <span class="text-sm md:text-base font-medium text-gray-500">{{ __('Price') }}:</span>
                        <span class="text-base md:text-lg">{{ $race->price }} DH</span>
                    </div>

                    @if ($race->sponsors)
                        <div class="mt-6 w-full px-4 flex flex-wrap justify-center space-x-2 mb-4 ">
                            <p class="w-full text-center mb-6 text-2xl font-medium text-gray-500">{{ __('Sponsors') }}:
                            </p>
                            @foreach (json_decode($race->sponsors) as $index => $sponsor)
                                <div class="xl:w-1/3 lg:w-1/6  md:w-1/3 sm:w-1/2 py-5 mx-4 bg-gray-100 text-black">
                                    <a href="{{ $sponsor->link }}" class="mx-auto w-56 h-autorounded-xl">
                                        <p class="text-center text-lg px-4">
                                            {{ $sponsor->name }}
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="block text-base md:text-lg text-gray-400">{{ __('No sponsors available') }}.</p>
                    @endif

                    @if ($race->social_media)
                        <div class="mt-6 w-full px-4 flex flex-wrap justify-center space-x-2 mb-4 ">
                            <p class="w-full text-center mb-6 text-2xl font-medium text-gray-500">
                                {{ __('Social Media') }}:</p>
                            @foreach (json_decode($race->social_media) as $index => $socialMedia)
                                <a class="inline-flex items-center text-base md:text-lg text-green-500 hover:text-green-600 font-semibold"
                                    href="{{ $socialMedia->value }}">
                                    <span class="mr-3">{{ $socialMedia->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="block text-base md:text-lg text-gray-400">{{ __('No social media available') }}.</p>
                    @endif


                </div>
                <div class="w-full mt-10 flex justify-center">
                    <button type="button" @click="showRegistrationForm = true"
                        class="cursor-pointer mt-4 inline-flex items-center md:text-lg bg-redBrick-600 py-6 px-8 front-bold rounded-full text-white hover:bg-redBrick-800 hover:text-redBrick-200 focus:bg-redBrick-800 font-semibold">
                        <span class="mr-3">{{ __('Register Now') }}</span>
                        <svg width="8" height="10" viewbox="0 0 8 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.94667 4.74665C7.91494 4.66481 7.86736 4.59005 7.80666 4.52665L4.47333 1.19331C4.41117 1.13116 4.33738 1.08185 4.25617 1.04821C4.17495 1.01457 4.08791 0.997253 4 0.997253C3.82246 0.997253 3.6522 1.06778 3.52667 1.19331C3.46451 1.25547 3.4152 1.32927 3.38156 1.41048C3.34792 1.4917 3.33061 1.57874 3.33061 1.66665C3.33061 1.84418 3.40113 2.01445 3.52667 2.13998L5.72667 4.33331H0.666667C0.489856 4.33331 0.320286 4.40355 0.195262 4.52858C0.070238 4.6536 0 4.82317 0 4.99998C0 5.17679 0.070238 5.34636 0.195262 5.47138C0.320286 5.59641 0.489856 5.66665 0.666667 5.66665H5.72667L3.52667 7.85998C3.46418 7.92196 3.41458 7.99569 3.38074 8.07693C3.34689 8.15817 3.32947 8.24531 3.32947 8.33331C3.32947 8.42132 3.34689 8.50846 3.38074 8.5897C3.41458 8.67094 3.46418 8.74467 3.52667 8.80665C3.58864 8.86913 3.66238 8.91873 3.74361 8.95257C3.82485 8.98642 3.91199 9.00385 4 9.00385C4.08801 9.00385 4.17514 8.98642 4.25638 8.95257C4.33762 8.91873 4.41136 8.86913 4.47333 8.80665L7.80666 5.47331C7.86736 5.40991 7.91494 5.33515 7.94667 5.25331C8.01334 5.09101 8.01334 4.90895 7.94667 4.74665Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="showRegistrationForm">
            @livewire('front.registration-form', ['race' => $race])
        </div>

    </div>
</div>
