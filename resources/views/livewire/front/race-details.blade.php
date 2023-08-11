<div>

    @section('meta')
        <meta itemprop="url" content="{{ URL::current() }}" />
        <meta property="og:title" content="{{ $race->meta_title }}">
        <meta property="og:description" content="{!! $race->meta_description !!}">
        <meta property="og:url" content="{{ URL::current() }}">
        <meta property="og:image" content="{{ $race->getFirstMediaUrl('local_files') }}">
        <meta property="og:image:secure_url" content="{{ $race->getFirstMediaUrl('local_files') }}">
        <meta property="og:image:width" content="1000">
        <meta property="og:image:height" content="1000">
    @endsection

    @section('title', $race->name)

    <section style="background-image: url({{ $race->getFirstMediaUrl('local_files') }})"
        class="relative w-full pt-36 pb-16 h-[400px] bg-center bg-no-repeat bg-cover border-b shadow-md border-green-700">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="grid grid-cols-1 text-center mt-10 bottom-0 px-4">
            <div class="text-center z-10 my-2">
                <h3
                    class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                    {{ $race->name }}
                </h3>

                <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-2 inline-block">
                    <li
                        class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-white pr-4">
                        <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        <span class="px-2 text-white"> > </span>
                    </li>
                    <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white"
                        aria-current="page">
                        <a href="{{ URL::Current() }}">
                            {{ $race->category->name }}
                        </a>
                        <span class="px-2 text-white"> > </span>
                    </li>

                    <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white"
                        aria-current="page">
                        <a href="{{ URL::Current() }}">
                            {{ $race->name }}
                        </a>
                    </li>
                </ul>

                <div class="px-4 mt-4 gap-[1.88rem] flex text-2xl items-center justify-between text-white">
                    <div style="word-break: break-word;">
                        <h3 class="text-white text-lg font-medium leading-8 mb-3 uppercase">Date</h3>

                        <p><strong class="font-bold">
                                {{ \Carbon\Carbon::parse($race->date)->format('l j F Y') }}
                            </strong></p>
                    </div>
                    <div style="word-break: break-word;">
                        <h3 class="text-white text-lg font-medium leading-8 mb-3 uppercase">Lieu</h3>
                        <p>
                            {{ $race?->location->name }}
                        </p>
                    </div>
                    @if ($race->social_media)
                        <div style="word-break: break-word;">
                            <h3 class="text-white text-lg font-medium leading-8 mb-3 uppercase">Réseaux Sociaux</h3>
                            <x-theme.social-media-icons :socialMedia="$race->social_media" />
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
    <section class="flex flex-wrap" x-data="{ showRegistrationForm: false, activeTab: 'tab0', tabs: '0' }">
        <div class="md:hidden sm:block w-full h-auto max-w-screen-xl mx-auto pb-5">
            <div
                class="overflow-y-auto flex sm:justify-start lg:justify-center text-sm relative bg-gray-100 border-b-2 border-green-600">
                <a href="#tab0"
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    @click="activeTab = 'tab0'"
                    :class="{
                        'bg-green-700': activeTab === 'tab0',
                        'text-white': activeTab === 'tab0',
                        'hover:text-green-400': activeTab === 'tab0',
                    }">
                    {{ __('Overview') }}
                </a>
                <a href="#tab1"
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    @click="activeTab = 'tab1'"
                    :class="{
                        'bg-green-700': activeTab === 'tab1',
                        'text-white': activeTab === 'tab1',
                        'hover:text-green-400': activeTab === 'tab1',
                    }">
                    {{ __('Details') }}
                </a>
                <a href="#tab2"
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    @click="activeTab = 'tab2'"
                    :class="{
                        'bg-green-700': activeTab === 'tab2',
                        'text-white': activeTab === 'tab2',
                        'hover:text-green-400': activeTab === 'tab2',
                    }">
                    {{ __('Regitration') }}
                </a>
            </div>
        </div>

        <div class="w-full flex flex-wrap h-full mt-2 pb-4 mx-2">
            <div class="xl:w-1/4 md:w-full px-4">
                <div class="text-gray-700 break-words ">
                    <div class="my-6 ">
                        <div class="flex flex-col justify-start overflow-x-hidden ">
                            <a href="#tab0" @click="activeTab = 'tab0'"
                                class="items-center border-b text-gray-500 cursor-pointer flex font-semibold  border-z·inc-200 border-solid p-5"
                                :class="{
                                    'bg-green-700': activeTab === 'tab0',
                                    'text-white': activeTab === 'tab0',
                                    'hover:text-green-400': activeTab === 'tab0',
                                }">
                                {{ __('Overview') }}
                            </a>
                            <a href="#tab1"
                                class="items-center border-b text-gray-500 cursor-pointer flex font-semibold  border-gray-200 border-solid p-5"
                                @click="activeTab = 'tab1'"
                                :class="{
                                    'bg-green-700': activeTab === 'tab1',
                                    'text-white': activeTab === 'tab1',
                                    'hover:text-green-400': activeTab === 'tab1',
                                }">
                                {{ __('Course') }}
                            </a>
                            <a href="#tab2"
                                class="items-center border-b text-gray-500 cursor-pointer flex font-semibold  border-z·inc-200 border-solid p-5"
                                @click="activeTab = 'tab2'"
                                :class="{
                                    'bg-green-700': activeTab === 'tab2',
                                    'text-white': activeTab === 'tab2',
                                    'hover:text-green-400': activeTab === 'tab2',
                                }">
                                {{ __('Regitration') }}
                            </a>

                            <a href="#sponsors"
                                class="items-center border-b text-gray-500 cursor-pointer flex font-semibold  border-gray-200 border-solid p-5">
                                {{ __('Sponsors') }}
                            </a>
                            <a href=""
                                class="items-center border-b text-gray-500 cursor-pointer flex font-semibold  border-gray-200 border-solid p-5">
                                Results
                            </a>
                            <a href="{{ route('front.catalog') }}" target="_blank"
                                class="items-center border-b text-gray-500 cursor-pointer flex font-semibold  border-gray-200 border-solid p-5">
                                {{ __('Shop') }}
                            </a>
                        </div>
                    </div>
                </div>

                <p class="text-black text-sm text-left md:text-base lg:text-lg lg:text-center mt-4">
                    {{ __('Registration deadline') }}
                </p>
                <p class="text-black text-sm text-left md:text-base lg:text-lg lg:text-center mt-4">
                    {{ Helpers::format_date($race->registration_deadline) }}
                </p>
            </div>
            <div class="xl:w-3/4 md:w-full">
                <div x-show="activeTab === 'tab0'" id="tab0" class="w-full text-center mb-5 border px-4">
                    <h3
                        class="w-full text-center mb-6 pt-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold tracking-tight uppercase text-gray-800">
                        {{ __('Details') }}
                    </h3>

                    <div
                        class="relative flex flex-col p-8 shadow-sm rounded-2xl border-skin-base bg-skin-card/50 backdrop-blur-sm">
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
                                class="text-sm md:text-base font-medium text-gray-500">{{ __('Number of Days') }}:</span>
                            <span class="text-base md:text-lg">{{ $race->elevation_gain }}</span>
                        </div>

                        <div class="mb-4">
                            <span
                                class="text-sm md:text-base font-medium text-gray-500">{{ __('Number of Racers') }}:</span>
                            <span class="text-base md:text-lg">{{ $race->number_of_racers }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="text-sm md:text-base font-medium text-gray-500">{{ __('Price') }}:</span>
                            <span class="text-base md:text-lg">{{ Helpers::format_currency($race->price) }}</span>
                        </div>
                        <div class="w-full text-center my-4">
                            @if ($race->calendar)
                                <div class="pb-6 px-6 mx-2 overflow-x-auto scrollbar__inverted">
                                    <table
                                        class="table-auto w-full border-collapse text-center border bg-white shadow-md">
                                        <thead>
                                            <tr class="bg-red-500 text-white">
                                                <th class="text-left py-2 px-3">{{ __('Date') }}</th>
                                                <th class="w-1/4 py-2 px-3">{{ __('Start Time') }}</th>
                                                <th class="w-1/4 py-2 px-3">{{ __('End Time') }}</th>
                                                <th class="w-1/2 py-2 px-3">{{ __('Activity') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (json_decode($race->calendar) as $data)
                                                <tr class="border-b bg-gray-100">
                                                    <td class="text-left py-2 px-3 font-bold">{{ $data->date }}</td>
                                                    <td class="py-2 px-3"></td>
                                                    <td class="py-2 px-3"></td>
                                                    <td class="py-2 px-3"></td>
                                                </tr>
                                                @foreach ($data->events as $event)
                                                    <tr class="border-b">
                                                        <td class="py-2 px-3"></td>
                                                        <td class="py-2 px-3">{{ $event->start_time }}</td>
                                                        <td class="py-2 px-3">{{ $event->end_time }}</td>
                                                        <td class="py-2 px-3">{{ $event->activity }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="block text-base md:text-lg text-gray-400">{{ __('No calendar available') }}.
                                </p>
                            @endif

                        </div>
                    </div>
                    <button type="button" @click="activeTab = 'tab2'"
                        class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-body focus:ring-green-500 w-full my-4">
                        {{ __('Register now') }}
                    </button>


                </div>
                <div x-show="activeTab === 'tab1'" id="tab1" class="w-full text-center mb-5 border px-4">
                    <div class="w-full text-center mb-5">
                        @if ($race->course)
                            <p class="w-full text-center py-10 mb-6 text-5xl font-bold uppercase text-gray-800">
                                {{ __('Details') }}
                            </p>
                            <div class="px-10 pb-6">
                                <div class="grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2">
                                    @foreach (json_decode($race->course) as $index => $course)
                                        <div class="w-full">
                                            <button
                                                class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold text-green-800 uppercase border-b-2 border-green-400 focus:outline-none cursor-pointer"
                                                type="button" @click="tabs = '{{ $index }}'"
                                                :class="{
                                                    'border-green-800 text-green-100 bg-green-700': tabs ===
                                                        '{{ $index }}',
                                                    'hover:bg-green-600 hover:text-green-100 hover:border-green-600': tabs !==
                                                        '{{ $index }}',
                                                }">
                                                <h4 class="inline-block"
                                                    :class="{
                                                        'text-green-100': tabs === '{{ $index }}',
                                                        'border-green-800': tabs === '{{ $index }}',
                                                    }">
                                                    {{ $course->name }}
                                                </h4>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="grid grid-cols-1 justify-center">
                                    @foreach (json_decode($race->course) as $index => $course)
                                        <div x-show="tabs === '{{ $index }}'">
                                            <div role="{{ $index }}" id="tab-panel-{{ $loop->index }}"
                                                class="w-full mb-4 border border-green-400">
                                                <ul class="flex flex-col text-center justify-center py-10">
                                                    <li class="leading-6 text-base md:text-lg">
                                                        Type: ({{ $course->type }})
                                                    </li>
                                                    <li class="leading-6 text-base md:text-lg">
                                                        Distance: {{ $course->distance }} km
                                                    </li>
                                                    @if ($race->category->name === 'Trail Running')
                                                        <li class="leading-6 text-base md:text-lg">
                                                            Elevation Gain: {{ $course->elevation_gain }} m
                                                        </li>
                                                    @endif
                                                    <li class="leading-6 text-base md:text-lg">
                                                        Number of Days: {{ $race->number_of_days }}
                                                    </li>
                                                    <li class="leading-6 px-6 py-4 text-base md:text-lg">
                                                        <p>
                                                            {{ $course->content }}
                                                        </p>
                                                    </li>
                                                </ul>
                                                <div class="flex justify-center py-4">
                                                    <x-button secondary type="button">{{ __('download') }}</x-button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p class="block text-base md:text-lg text-gray-400">{{ __('No race details available') }}.
                            </p>
                        @endif

                    </div>
                </div>
                <div x-show="activeTab === 'tab2'" id="tab2" class="w-full text-center mb-5 border px-4">
                    <div class="w-full text-center mb-5">
                        @php
                            $registrationDeadline = \Carbon\Carbon::parse($race->registration_deadline);
                        @endphp

                        @if ($registrationDeadline->isBefore(\Carbon\Carbon::now()))
                            <div
                                class="bg-gray-200 text-neutral-700 break-words pl-8 pr-5  border border-gray-300 border-solid rounded-">
                                <div class="clear-both float-left my-3.5 ">
                                    <h3 class="text-neutral-700 text-4xl font-semibold mb-5 ">
                                        {{ __('Registration Coming Soon') }}
                                    </h3>
                                    <p class=" text-center">
                                        {{ $race->name }} {{ __('registration is now closed') }}
                                    </p>
                                </div>

                            </div>
                        @else
                            @livewire('front.registration-form', ['race' => $race])
                        @endif
                    </div>
                </div>
            </div>
            <hr class="w-full border-gray-300 mt-3">
            <div class="w-full bg-gray-50" id="sponsors">
                @if ($race->sponsors)
                    <div class="text-gray-500 text-sm px-3.5">
                        <p
                            class="w-full text-center mb-6 py-5 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                            {{ __('Sponsors') }}
                        </p>
                        <div class="w-full flex-wrap mx-auto px-10">
                            @foreach (json_decode($race->sponsors) as $sponsor)
                                <div class="w-1/4 basis-full float-left">
                                    <a href="{{ $sponsor->link }}" class="text-center">
                                        <img src="" alt="{{ $sponsor->name }}"
                                            class="inline-block h-24 align-middle w-20">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-gray-500 text-sm font-medium py-10 text-center">
                        <p class="block text-base md:text-lg text-gray-400">{{ __('No sponsors available') }}.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="py-18 2xl:py-36 font-medium overflow-hidden bg-green-50" x-data="{
        expandFaq: null,
        slideIndex: 0,
        totalSlides: {{ count(Helpers::getActiveFaqs()) }},
        nextSlide() {
            this.slideIndex = (this.slideIndex + 1) % this.totalSlides;
        },
        prevSlide() {
            this.slideIndex = (this.slideIndex - 1 + this.totalSlides) % this.totalSlides;
        },
        goToSlide(index) {
            this.slideIndex = index;
        }
    }">
        <div class="container relative px-4 py-10 mx-auto">

            <h2 class="mb-10 font-heading text-9xl md:text-10xl xl:text-11xl leading-tight">
                {{ "FAQ's" }}</h2>
            <div class="flex transition-all duration-500 relative" :style="{ left: -(slideIndex * 100) + '%' }">
                @foreach (Helpers::getActiveFaqs() as $index => $faq)
                    <div class="flex-shrink-0 px-4 lg:px-1 w-full lg:w-1/3">
                        <div class="relative py-9 px-16 h-full bg-white rounded-3xl">
                            <h3 class="font-heading mb-4 text-3xl md:text-4xl font-bold leading-tighter">
                                {{ $faq->title }}</h3>
                            <a @click="expandFaq = {{ $index }}"
                                class="absolute -bottom-6 right-10 w-12 h-12 bg-green-500 rounded-full cursor-pointer flex items-center justify-center">
                                <i class="fas fa-arrow-down text-white"></i>
                            </a>
                            <div x-show="expandFaq === {{ $index }}"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                                class="py-10 mt-6 border-t border-gray-200">
                                <p class="text-md">{{ $faq->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex items-center mx-auto w-full md:w-1/2 xl:w-full max-w-max">
                <a @click="prevSlide" class="mr-4 lg:mr-8 xl:mr-24 cursor-pointer">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="flex mx-auto w-56 lg:w-96 bg-gray-100" style="height: 2px;">
                    @foreach (Helpers::getActiveFaqs() as $index => $slider)
                        <div class="w-14 h-1 bg-gray-300 cursor-pointer transition-colors hover:bg-red-500 bg-opacity-50"
                            :class="{ 'bg-red-500': slideIndex === {{ $index }} }"
                            @click="goToSlide({{ $index }})"></div>
                    @endforeach
                </div>
                <a @click="nextSlide" class="ml-4 lg:ml-8 xl:ml-24 cursor-pointer">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
</div>
