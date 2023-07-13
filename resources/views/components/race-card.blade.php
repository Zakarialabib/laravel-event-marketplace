@props(['race', 'view'])

@if ($view == 'list')
    <div
        class="flex flex-wrap items-center bg-gray-50 rounded-lg w-full border-2 border-green-800 transition duration-300 ease-in-out delay-200 transform shadow-2xl md:hover:translate-x-0 md:hover:translate-y-8">
        <a href="{{ route('front.raceDetails', $race->slug) }}"
            class="w-full lg:w-1/2 flex items-center md:items-start relative h-full transition-all duration-300 group-hover:scale-110 group-hover:opacity-75"
            style="background-image: url({{ $race->getFirstMediaUrl('local_files') }});background-size: cover;background-position: center;height:27rem">
            <div class="absolute top-0 left-0 p-4 bg-redBrick-600 text-white text-center shadow-xl rounded-br-xl">
                <p class="font-medium leading-leading-tight">
                    {{ \Carbon\Carbon::parse($race->date)->format('F') }}</p>
                <p class="font-extrabold text-2xl leading-tight">
                    {{ \Carbon\Carbon::parse($race->date)->format('d') }}</p>
                <p class="leading-tight">{{ \Carbon\Carbon::parse($race->date)->format('Y') }}</p>
            </div>
        </a>
        <div class="w-full lg:w-1/2 py-10 relative">
            <div class="px-4 text-center">
                <a class="block mb-4 text-2xl leading-6 text-gray-800 hover:text-gray-900 font-bold hover:underline"
                    href="{{ route('front.raceDetails', $race->slug) }}">
                    {{ $race->name }}
                </a>
                <div class="flex flex-wrap py-4 gap-8 justify-center items-center">
                    <p class="flex items-center">
                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                            <i class="fas fa-calendar-check mr-2"></i>
                            {{ __('Registration Deadline') }}
                        </span>
                        <span class="text-base md:text-lg capitalize">{{ Helpers::format_date($race->registration_deadline) }}</span>
                    </p>
                    <p class="flex items-center">
                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <span class="text-base md:text-lg capitalize">{{ $race->location->name }}</span>
                    </p>
                    <p class="flex items-center">
                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                            <i class="fas fa-tags"></i>
                        </span>
                        <span class="text-base md:text-lg capitalize">{{ $race->category->name }}</span>
                    </p>
                    <p class="flex items-center">
                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <span class="text-base md:text-lg capitalize">{{ $race->number_of_days }}
                            {{ __('days') }}</span>
                    </p>
                    <p class="flex items-center">
                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                            <i class="fas fa-users"></i>
                        </span>
                        <span class="text-base md:text-lg capitalize">{{ $race->number_of_racers }}</span>
                    </p>
                    <p class="flex items-center">
                        <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                            <i class="fas fa-money-bill-wave"></i>
                        </span>
                        <span class="text-base md:text-lg capitalize">{{ Helpers::format_currency($race->price) }}</span>
                    </p>

                    @if ($race->course)
                        <ul class="flex items-center gap-4">
                            @foreach ($race->course as $key => $course)
                                <li class="text-base inline-flex md:text-lg">
                                    <span
                                        class="text-xs uppercase px-[10px] py-[5px] tracking-widest whitespace-nowrap inline-block rounded-md bg-green-500 hover:bg-green-800 text-white">
                                        {{ $course['name'] }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="py-2 flex w-full">
                        <a href="{{ route('front.raceDetails', $race->slug) }}"
                            class="bottom-0 w-full text-center cursor-pointer border-2 border-green-600 py-3 px-2 text-lg front-bold text-green-600 transition ease-in-out duration-300 hover:bg-green-800 hover:text-green-100 focus:bg-green-800 font-semibold uppercase">
                            {{ __('See more') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($view == 'grid')
    <div
        class="group rounded-md bg-white dark:bg-slate-900 shadow hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-800 dark:hover:shadow-gray-700 overflow-hidden ease-in-out duration-500">
        <a class="relative" href="{{ route('front.raceDetails', $race->slug) }}">
            <img src="{{ $race->getFirstMediaUrl('local_files') }}" alt="{{ $race->name }}">
            <div
                class="absolute top-0 left-0 pt-6 pb-4 px-4 bg-redBrick-600 text-white text-center shadow-xl rounded-br-xl opacity-90">
                <p class="font-medium leading-leading-tight">
                    {{ \Carbon\Carbon::parse($race->date)->format('F') }}</p>
                <p class="font-extrabold text-2xl leading-tight">
                    {{ \Carbon\Carbon::parse($race->date)->format('d') }}</p>
                <p class="leading-tight">{{ \Carbon\Carbon::parse($race->date)->format('Y') }}</p>
            </div>
        </a>

        <div class="p-6">
            <div class="pb-6 text-center">
                <a href="{{ route('front.raceDetails', $race->slug) }}"
                    class="text-xl hover:text-indigo-600 font-medium ease-in-out duration-500">
                    {{ $race->name }}
                </a>
            </div>

            <ul
                class="w-full py-6 border-t border-gray-100 dark:border-gray-800 grid grid-cols-2 gap-4 justify-center items-center list-none">
                <li class="flex items-center me-4">
                    <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <span class="text-base md:text-lg capitalize">{{ $race->location->name }}</span>
                </li>
                <li class="flex items-center me-4">
                    <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                        <i class="fas fa-tags"></i>
                    </span>
                    <span class="text-base md:text-lg capitalize">{{ $race->category->name }}</span>
                </li>
                <li class="flex items-center me-4">
                    <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    <span class="text-base md:text-lg capitalize">{{ $race->number_of_days }}
                        {{ __('days') }}</span>
                </li>
                <li class="flex items-center me-4">
                    <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="text-base md:text-lg capitalize">{{ $race->number_of_racers }}</span>
                </li>
            </ul>
            @if ($race->course)
                <ul class="flex gap-4 w-full pb-4 justify-center text-center border-b border-gray-100 dark:border-gray-800 ">
                    @foreach ($race->course as $key => $course)
                        <li class="text-base inline-flex md:text-lg">
                            <span
                                class="text-xs uppercase px-[10px] py-[5px] tracking-widest whitespace-nowrap inline-block rounded-md bg-green-500 hover:bg-green-800 text-white">
                                {{ $course['name'] }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
            <ul class="pt-6 grid grid-cols-2 gap-4 justify-center items-center list-none py-6">
                <li>
                    <span class="text-slate-400">{{ __('Price') }}</span>
                    <p class="text-lg font-medium">{{ Helpers::format_currency($race->price) }}</p>
                </li>
                <li>
                    <a href="{{ route('front.raceDetails', $race->slug) }}"
                        class="bottom-0 block text-center cursor-pointer border-2 border-green-600 py-3 text-lg front-bold text-green-600 transition ease-in-out duration-300 hover:bg-green-800 hover:text-green-100 focus:bg-green-800 font-semibold uppercase">
                        {{ __('See more') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endif
