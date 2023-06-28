<div>
    <section style="background-image: url({{ $race->getFirstMediaUrl('local_files') }})"
        class="relative table w-full py-64 bg-center bg-no-repeat bg-cover border-b shadow-md border-redBrick-700">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="px-4">
            <div class="grid grid-cols-1 text-center mt-10">
                <div class="absolute text-center z-10 bottom-5 start-0 end-0 mx-3">
                    <h3
                        class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                        {{ $race->name }} {{ \Carbon\Carbon::parse($race->date)->format('F,d,Y') }}
                    </h3>
                    <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-0 inline-block">
                        <li
                            class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-white pr-4">
                            <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white"
                            aria-current="page">
                            <a href="{{ URL::Current() }}">
                                {{ $race->category->name }}
                            </a>
                        </li>
                        <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white"
                            aria-current="page">
                            <a href="{{ URL::Current() }}">
                                {{ $race->name }}
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
    <div class="flex flex-wrap" x-data="{ showRegistrationForm: false, activeTab: 'tab0', tabs: '' }">
        <div class="w-full md:w-1/4 lg:pb-14 sm:pb-0 h-auto bg-gray-100">
            <!-- Tab buttons -->
            <div
                class="w-full grid grid-cols-1 xl:grid-cols-1 lg:grid-cols-1 md:grid-cols-1 sm:grid-cols-2 xs:grid-cols-2 relative">
                <button
                    class="w-full py-3 md:px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab0'"
                    :class="{
                        'border-red-700': activeTab === 'tab0',
                        'bg-redBrick-700': activeTab === 'tab0',
                        'text-redBrick-200': activeTab === 'tab0',
                        'hover:text-red-500': activeTab === 'tab0',
                    }">
                    <h4 class="inline-block" :class="{ 'text-redBrick-100': activeTab === 'tab0' }">
                        Overview
                    </h4>
                </button>
                <button
                    class="w-full py-3 md:px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab1'"
                    :class="{
                        'border-red-700': activeTab === 'tab1',
                        'bg-redBrick-700': activeTab === 'tab1',
                        'text-redBrick-200': activeTab === 'tab1',
                        'hover:text-red-500': activeTab === 'tab1',
                    }">
                    <h4 class="inline-block" :class="{ 'text-redBrick-100': activeTab === 'tab1' }">
                        Detail
                    </h4>
                </button>
                <button
                    class="w-full py-3 md:px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab2'"
                    :class="{
                        'border-red-700': activeTab === 'tab2',
                        'bg-redBrick-700': activeTab === 'tab2',
                        'text-redBrick-200': activeTab === 'tab2',
                        'hover:text-red-500': activeTab === 'tab2',
                    }">
                    <h4 class="inline-block" :class="{ 'text-redBrick-100': activeTab === 'tab2' }">
                        Calendar
                    </h4>

                </button>
                <button
                    class="w-full py-3 md:px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab3'"
                    :class="{
                        'border-red-700': activeTab === 'tab3',
                        'bg-redBrick-700': activeTab === 'tab3',
                        'text-redBrick-200': activeTab === 'tab3',
                        'hover:text-red-500': activeTab === 'tab3',
                    }">
                    <h4 class="inline-block" :class="{ 'text-redBrick-100': activeTab === 'tab3' }">
                        Sponsors
                    </h4>
                </button>
                <button
                    class="w-full py-3 md:px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab4'"
                    :class="{
                        'border-red-700': activeTab === 'tab4',
                        'bg-redBrick-700': activeTab === 'tab4',
                        'text-redBrick-200': activeTab === 'tab4',
                        'hover:text-red-500': activeTab === 'tab4',
                    }">
                    <h4 class="inline-block" :class="{ 'text-redBrick-100': activeTab === 'tab4' }">
                        Regitration
                    </h4>
                </button>
            </div>

        </div>

        <div class="w-full md:w-3/4 h-auto">

            <!-- Tab content -->
            <div x-show="activeTab === 'tab0'">

                <div class="w-full text-center mb-5">
                    <p
                        class="w-full text-center mb-6 py-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                        {{ __('Overview') }}
                    </p>
                    <div class="grid grid-cols-1 gap-4 pb-6">
                        <p class="mb-7 text-base md:text-lg text-gray-400 font-medium">{!! $race->description !!}</p>

                        <div class="mb-4">
                            <span
                                class="text-sm md:text-base font-medium text-gray-500">{{ __('Race Location') }}:</span>
                            <span class="text-base md:text-lg">{{ $race?->location->name }}</span>
                        </div>

                        <div class="mb-4">
                            <span
                                class="text-sm md:text-base font-medium text-gray-500">{{ __('Number of Days') }}:</span>
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
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 'tab1'">
                <div class="w-full text-center mb-5">
                    <p class="w-full text-center py-10 mb-6 text-5xl font-bold uppercase text-gray-800">
                        {{ __('Details') }}
                    </p>
                    <div class="px-10 pb-6">
                        @php
                            $categoryName = strtolower($race->category->name);
                        @endphp

                        @if ($race->course)
                            <div class="grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 ">
                                @foreach ($race->course as $key => $course)
                                    @if ($categoryName == $key || $categoryName == 'triathlon')
                                        <div class="w-full">
                                            <button
                                                class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold text-redBrick-800 uppercase border-b-2 border-redBrick-400 focus:outline-none cursor-pointer"
                                                type="button" @click="tabs = '{{ $key }}'"
                                                :class="{
                                                    'border-redBrick-800': tabs === '{{ $key }}',
                                                    'text-redBrick-100': tabs === '{{ $key }}',
                                                    'bg-redBrick-700': tabs === '{{ $key }}',
                                                    'hover:bg-redBrick-600': tabs !== '{{ $key }}',
                                                    'hover:text-redBrick-100': tabs !== '{{ $key }}',
                                                    'hover:border-redBrick-600': tabs !== '{{ $key }}',
                                                }">
                                                <h4 class="inline-block"
                                                    :class="{
                                                        'text-redBrick-100': tabs === '{{ $key }}',
                                                        'border-redBrick-800': tabs === '{{ $key }}',
                                                    }">
                                                    {{ $course['name'] }}
                                                </h4>
                                            </button>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="grid grid-cols-1 justify-center py-6 px-4">
                                @foreach ($race->course as $key => $course)
                                    <div x-show="tabs === '{{ $key }}'">
                                        <div role="{{ $key }}" id="tab-panel-{{ $loop->index }}"
                                            class="w-full mb-4">
                                            <div class="flex flex-col text-center justify-center py-10">
                                                <p class="leading-6 text-base md:text-lg py-10">
                                                    {{ $course['content'] }}
                                                </p>

                                                <div class="flex justify-center">
                                                    <x-button secondary type="button">{{ __('download') }}</x-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 'tab2'">
                <div class="w-full text-center mb-5">
                    @if ($race->calendar)
                        <p
                            class="w-full text-center mb-6 py-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                            {{ __('Calendar') }}
                        </p>
                        <div class="pb-6 px-6 mx-2 overflow-x-auto scrollbar__inverted">
                        <table class="table-auto w-full border-collapse text-center border bg-white shadow-md">
                            <thead>
                                <tr class="bg-red-500 text-white">
                                    <th class="text-left py-2 px-3">{{ __('Date') }}</th>
                                    <th class="w-1/4 py-2 px-3">{{ __('Start Time') }}</th>
                                    <th class="w-1/4 py-2 px-3">{{ __('End Time') }}</th>
                                    <th class="w-1/2 py-2 px-3">{{ __('Activity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($race->calendar as $data)
                                    <tr class="border-b bg-gray-100">
                                        <td class="text-left py-2 px-3 font-bold">{{ $data['date'] }}</td>
                                        <td class="py-2 px-3"></td>
                                        <td class="py-2 px-3"></td>
                                        <td class="py-2 px-3"></td>
                                    </tr>
                                    @foreach ($data['events'] as $event)
                                        <tr class="border-b">
                                            <td class="py-2 px-3"></td>
                                            <td class="py-2 px-3">{{ $event['start_time'] }}</td>
                                            <td class="py-2 px-3">{{ $event['end_time'] }}</td>
                                            <td class="py-2 px-3">{{ $event['activity'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p class="block text-base md:text-lg text-gray-400">{{ __('No calendar available') }}.</p>
                    @endif

                </div>
            </div>
            <div x-show="activeTab === 'tab3'">
                <div class="w-full text-center mb-5">
                    @if ($race->sponsors)
                        <p
                            class="w-full text-center mb-6 py-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                            {{ __('Sponsors') }}
                        </p>
                        <div
                            class="grid sm:grid-cols-3 md:grid-cols-4 lg:w-grid-cols-5 xl:grid-cols-6  gap-4  justify-center py-6 px-4">

                            @foreach ($race->sponsors as $index => $sponsor)
                                <div class="py-5 bg-gray-100 text-black w-full px-4">
                                    <a href="{{ $sponsor['link'] }}" class="mx-auto h-auto rounded-xl">
                                        <p class="text-center text-base ">
                                            {{ $sponsor['name'] }}
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="block text-base md:text-lg text-gray-400">{{ __('No sponsors available') }}.</p>
                    @endif
                </div>
            </div>
            <div x-show="activeTab === 'tab4'">
                @livewire('front.registration-form', ['race' => $race])
            </div>
            @if ($race->social_media)
            <div class="flex flex-wrap bg-gray-100 items-center py-6 w-full ">
                <div class="w-full px-4 flex flex-wrap justify-center space-x-2 mb-4 ">
                    <p class="w-full text-center mb-6 text-2xl font-medium text-gray-500">
                        {{ __('Social Media') }}:
                    </p>
                    <x-theme.social-media-icons :socialMedia="$race->social_media" />
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
