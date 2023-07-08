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
        class="relative table w-full py-64 bg-center bg-no-repeat bg-cover border-b shadow-md border-green-700">
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
                    @if ($race->social_media)
                        <div class="flex flex-wrap items-center py-6 w-full ">
                            <div class="w-full px-4 flex flex-wrap text-white justify-center space-x-2 mb-4 ">
                                <x-theme.social-media-icons :socialMedia="$race->social_media" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="flex flex-wrap" x-data="{ showRegistrationForm: false, activeTab: 'tab0', tabs: '' }">
        <div class="w-full h-auto max-w-screen-xl mx-auto pb-5">
            <!-- Tab buttons -->
            <div
                class="overflow-y-auto flex sm:justify-start lg:justify-center text-sm relative bg-gray-100 border-b-2 border-green-600">
                <button
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab0'"
                    :class="{
                        'bg-green-700': activeTab === 'tab0',
                        'text-white': activeTab === 'tab0',
                        'hover:text-green-400': activeTab === 'tab0',
                    }">
                    {{ __('Overview') }}
                </button>
                <button
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab1'"
                    :class="{
                        'bg-green-700': activeTab === 'tab1',
                        'text-white': activeTab === 'tab1',
                        'hover:text-green-400': activeTab === 'tab1',
                    }">
                    {{ __('Details') }}
                </button>
                <button
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab2'"
                    :class="{
                        'bg-green-700': activeTab === 'tab2',
                        'text-white': activeTab === 'tab2',
                        'hover:text-green-400': activeTab === 'tab2',
                    }">
                    {{ __('Calendar') }}

                </button>
                <button
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab3'"
                    :class="{
                        'bg-green-700': activeTab === 'tab3',
                        'text-white': activeTab === 'tab3',
                        'hover:text-green-400': activeTab === 'tab3',
                    }">
                    {{ __('Sponsors') }}
                </button>
                <button
                    class="py-3 px-4 md:px-8 text-center font-bold text-green-600 uppercase hover:border-green-500 focus:outline-none focus:border-green-500 cursor-pointer"
                    type="button" @click="activeTab = 'tab4'"
                    :class="{
                        'bg-green-700': activeTab === 'tab4',
                        'text-white': activeTab === 'tab4',
                        'hover:text-green-400': activeTab === 'tab4',
                    }">
                    {{ __('Regitration') }}
                </button>
            </div>
        </div>

        <div class="w-full flex items-center h-full">
            <div class="w-1/4 px-4 py-6">
                <p class="text-black text-sm md:text-base lg:text-lg mt-4">
                    {{ __('Registration deadline') }}
                </p>
                <p class="text-black text-sm md:text-base lg:text-lg mt-4">
                    {{ $race->registration_deadline->format('d-m-Y') }}
                </p>
            </div>
            <div class="w-3/4">
                <!-- Tab content -->
                <div x-show="activeTab === 'tab0'" class="w-full text-center mb-5">
                    <h3
                        class="w-full text-center mb-6 pt-10 text-3xl lg:text-5xl md:text-3xl sm:text-xl font-bold uppercase text-gray-800">
                        {{ __('Overview') }}
                    </h3>
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
                            <span class="text-base md:text-lg">{{ Helpers::format_currency($race->price) }}</span>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 'tab1'">
                    <div class="w-full text-center mb-5">
                        @if ($race->course)
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
                                                        class="w-full py-5 px-8 sm:py-2 sm:px-5 text-center font-bold text-green-800 uppercase border-b-2 border-green-400 focus:outline-none cursor-pointer"
                                                        type="button" @click="tabs = '{{ $key }}'"
                                                        :class="{
                                                            'border-green-800': tabs === '{{ $key }}',
                                                            'text-green-100': tabs === '{{ $key }}',
                                                            'bg-green-700': tabs === '{{ $key }}',
                                                            'hover:bg-green-600': tabs !== '{{ $key }}',
                                                            'hover:text-green-100': tabs !== '{{ $key }}',
                                                            'hover:border-green-600': tabs !== '{{ $key }}',
                                                        }">
                                                        <h4 class="inline-block"
                                                            :class="{
                                                                'text-green-100': tabs === '{{ $key }}',
                                                                'border-green-800': tabs === '{{ $key }}',
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
                                                            <x-button secondary type="button">{{ __('download') }}
                                                            </x-button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="block text-base md:text-lg text-gray-400">{{ __('No race details available') }}.
                            </p>
                        @endif
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
                    <div class="w-full text-center mb-5">
                    @php
                    $registrationDeadline = \Carbon\Carbon::parse($race->registration_deadline);
                    @endphp
                    
                    @if($registrationDeadline->isBefore(\Carbon\Carbon::now()))
                    <p class="block text-base md:text-lg text-gray-400">{{ __('Registration is over') }}.</p>
                    @else
                        @livewire('front.registration-form', ['race' => $race])
                    @endif
                    </div>
                </div>
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
                <div class="flex mx-auto w-56 lg:w-96 h-px bg-gray-100" style="height: 2px;">
                    @foreach (Helpers::getActiveFaqs() as $index => $slider)
                        <div class="w-14 h-1 bg-gray-300 cursor-pointer transition-colors hover:bg-red-500 bg-opacity-50"
                            :class="{ 'bg-red-500': slideIndex === {{ $index }} }"
                            @click="goToSlide({{ $index }})"></div>
                    @endforeach
                    <a class="w-2/3 bg-white" href="#"></a>
                </div>
                <a @click="nextSlide" class="ml-4 lg:ml-8 xl:ml-24 cursor-pointer">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
</div>
