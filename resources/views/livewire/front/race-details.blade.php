<div>
    <div class="flex flex-wrap bg-gray-200" x-data="{ showRegistrationForm: false, activeTab: 'tab0', tabs: '' }">
        <div class="w-full">
            <div class="relative flex justify-center">
                <img src="{{ $race->getFirstMediaUrl('local_files') }}" alt="Race Image"
                    class="w-screen h-[320px] object-center object-fill">
                <p
                    class="bg-white px-6 absolute bottom-0 mb-4 text-center leading-6 text-2xl text-redBrick-600 hover:text-redBrick-900 font-bold border-black drop-shadow-lg">
                    {{ \Carbon\Carbon::parse($race->date)->format('F,d,Y') }}
                </p>
            </div>

            <h3
                class="px-10 py-6 border-y-2 border-black bg-redBrick-500 z-50 text-white xl:text-6xl lg:text-5xl md:text-2xl sm:text-lg uppercase text-center font-bold">
                {{ $race->name }} - {{ $race->category->name }}
            </h3>

        </div>
        <div class="w-full md:w-1/4 py-14 bg-gray-100 h-auto border-r border-redBrick-700">
            <!-- Tab buttons -->
            <div class="w-full h-full">
                <button
                    class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
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
                    class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
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
                    class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
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
                    class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
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
                    class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
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

        <div class="w-full md:w-3/4 py-10 px-1 h-auto">

            <!-- Tab content -->
            <div x-show="activeTab === 'tab0'" >

                <div class="w-full text-center mb-5">
                    <p class="w-full text-center mb-6 text-5xl font-bold uppercase text-gray-800">
                        {{ __('Overview') }}
                    </p>
                    <p class="mb-7 text-base md:text-lg text-gray-400 font-medium">{!! $race->description !!}</p>

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
                </div>


            </div>
            <div x-show="activeTab === 'tab1'" >
                <p class="w-full text-center mb-6 text-5xl font-bold uppercase text-gray-800">
                    {{ __('Details') }}
                </p>
                <div class="grid gap-4 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 mb-10 ">
                    @php
                        $categoryName = strtolower($race->category->name);
                    @endphp

                    @if ($race->course)
                        @foreach ($race->course as $key => $course)
                            @if ($categoryName == $key || $categoryName == 'triathlon')
                                <div class="w-full">
                                    <button
                                        class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold bg-gray-100 text-red-600 uppercase border-b-2 border-redBrick-600 hover:border-red-500 focus:outline-none focus:border-red-500 cursor-pointer"
                                        type="button" @click="tabs = '{{ $key }}'"
                                        :class="{
                                            'border-red-200': '{{ $key }}',
                                            'text-red-700': '{{ $key }}',
                                            'hover:text-red-700': '{{ $key }}',
                                        }">
                                        <h4 class="inline-block" :class="{ 'text-redBrick-100': '{{ $key }}' }">
                                            {{ ucfirst($key) }}
                                        </h4>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                @if ($race->course)
                    <div class="">
                        @foreach ($race->course as $key => $course)
                            <div x-show="tabs === '{{ $key }}'">
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

                <div class="flex flex-wrap items-center  w-full ">

                    @if ($race->social_media)
                        <div class="w-full px-4 flex flex-wrap justify-center space-x-2 mb-4 ">
                            <p class="w-full text-center mb-6 text-2xl font-medium text-gray-500">
                                {{ __('Social Media') }}:
                            </p>
                            <x-theme.social-media-icons :socialMedia="$race->social_media" />
                        </div>
                    @else
                        <p class="block text-base md:text-lg text-gray-400">{{ __('No social media available') }}.
                        </p>
                    @endif


                </div>
               
            </div>
            <div x-show="activeTab === 'tab2'" >
                <div class="w-full px-4 mx-auto">

                    @if ($race->calendar)
                        <div class="w-full px-4">
                            <p class="w-full text-center mb-6 text-5xl font-bold uppercase text-gray-800">
                                {{ __('Calendar') }}
                            </p>
                            <table class="w-full border-collapse text-center border bg-white shadow-md">
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
            <div x-show="activeTab === 'tab3'" >
                @if ($race->sponsors)
                    <div class="w-full px-4 flex flex-wrap justify-center space-x-2 mb-4 ">
                        <p class="w-full text-center mb-6 text-5xl font-bold uppercase text-gray-800">
                            {{ __('Sponsors') }}
                        </p>
                        @foreach ($race->sponsors as $index => $sponsor)
                            <div class="xl:w-1/3 lg:w-1/6  md:w-1/3 sm:w-1/2 py-5 mx-4 bg-gray-100 text-black">
                                <a href="{{ $sponsor['link'] }}" class="mx-auto w-56 h-autorounded-xl">
                                    <p class="text-center text-lg px-4">
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
            <div x-show="activeTab === 'tab4'" >
                    @livewire('front.registration-form', ['race' => $race])
            </div>
        </div>
    </div>
</div>
