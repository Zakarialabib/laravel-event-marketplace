<div>
    @section('title', __('Update Race'))

    <section class="py-3 px-4">
        <div class="flex flex-wrap items-center justify-between">
            <div class="mb-5 lg:mb-0">
                <h4 class="mb-1 text-2xl font-bold">
                    {{ __('Update Race') }}
                </h4>
                <div class="flex items-center">
                    <a class="flex items-center text-sm text-gray-500" href="{{ route('admin.dashboard') }}">
                        <span class="inline-block mr-2">
                            <svg class="h-4 w-4 text-gray-500" viewBox="0 0 16 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.6666 5.66667L9.66662 1.28333C9.20827 0.873372 8.6149 0.646725 7.99996 0.646725C7.38501 0.646725 6.79164 0.873372 6.33329 1.28333L1.33329 5.66667C1.0686 5.9034 0.857374 6.1938 0.713683 6.51854C0.569993 6.84328 0.497134 7.1949 0.499957 7.55V14.8333C0.499957 15.4964 0.763349 16.1323 1.23219 16.6011C1.70103 17.0699 2.33692 17.3333 2.99996 17.3333H13C13.663 17.3333 14.2989 17.0699 14.7677 16.6011C15.2366 16.1323 15.5 15.4964 15.5 14.8333V7.54167C15.5016 7.18797 15.4282 6.83795 15.2845 6.51474C15.1409 6.19152 14.9303 5.90246 14.6666 5.66667V5.66667ZM9.66662 15.6667H6.33329V11.5C6.33329 11.279 6.42109 11.067 6.57737 10.9107C6.73365 10.7545 6.94561 10.6667 7.16662 10.6667H8.83329C9.0543 10.6667 9.26626 10.7545 9.42255 10.9107C9.57883 11.067 9.66662 11.279 9.66662 11.5V15.6667ZM13.8333 14.8333C13.8333 15.0543 13.7455 15.2663 13.5892 15.4226C13.4329 15.5789 13.221 15.6667 13 15.6667H11.3333V11.5C11.3333 10.837 11.0699 10.2011 10.6011 9.73223C10.1322 9.26339 9.49633 9 8.83329 9H7.16662C6.50358 9 5.8677 9.26339 5.39886 9.73223C4.93002 10.2011 4.66662 10.837 4.66662 11.5V15.6667H2.99996C2.77894 15.6667 2.56698 15.5789 2.4107 15.4226C2.25442 15.2663 2.16662 15.0543 2.16662 14.8333V7.54167C2.16677 7.42335 2.19212 7.30641 2.24097 7.19865C2.28982 7.09089 2.36107 6.99476 2.44996 6.91667L7.44996 2.54167C7.60203 2.40807 7.79753 2.33439 7.99996 2.33439C8.20238 2.33439 8.39788 2.40807 8.54996 2.54167L13.55 6.91667C13.6388 6.99476 13.7101 7.09089 13.7589 7.19865C13.8078 7.30641 13.8331 7.42335 13.8333 7.54167V14.8333Z"
                                    fill="currentColor"></path>
                            </svg></span>
                        <span>{{ __('Home') }}</span>
                    </a>
                    <span class="inline-block mx-4">
                        <svg class="h-2 w-2 text-gray-500" viewBox="0 0 6 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.23242 9.3689C1.06762 9.36887 0.906542 9.31997 0.769534 9.2284C0.632526 9.13683 0.525742 9.0067 0.462684 8.85445C0.399625 8.7022 0.383124 8.53467 0.415263 8.37304C0.447403 8.21141 0.526741 8.06294 0.643249 7.9464L3.58916 5L0.643224 2.05364C0.486959 1.89737 0.399171 1.68543 0.39917 1.46444C0.399169 1.24345 0.486957 1.03151 0.64322 0.875249C0.799483 0.718985 1.01142 0.631196 1.23241 0.631195C1.4534 0.631194 1.66534 0.718982 1.82161 0.875245L5.35676 4.41084C5.43416 4.48819 5.49556 4.58005 5.53745 4.68114C5.57934 4.78224 5.6009 4.8906 5.6009 5.00003C5.6009 5.10946 5.57934 5.21782 5.53745 5.31891C5.49556 5.42001 5.43416 5.51186 5.35676 5.58922L1.82161 9.12478C1.74432 9.20229 1.65249 9.26375 1.55137 9.30564C1.45026 9.34754 1.34186 9.36903 1.23242 9.3689Z"
                                fill="currentColor"></path>
                        </svg></span>
                    <a class="flex items-center text-sm" href="{{ URL::Current() }}">
                        <span class="inline-block mr-2">
                            <svg class="h-4 w-4 text-indigo-500" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.99992 10.8333H1.66659C1.44557 10.8333 1.23361 10.9211 1.07733 11.0774C0.921049 11.2337 0.833252 11.4457 0.833252 11.6667V18.3333C0.833252 18.5544 0.921049 18.7663 1.07733 18.9226C1.23361 19.0789 1.44557 19.1667 1.66659 19.1667H4.99992C5.22093 19.1667 5.43289 19.0789 5.58917 18.9226C5.74545 18.7663 5.83325 18.5544 5.83325 18.3333V11.6667C5.83325 11.4457 5.74545 11.2337 5.58917 11.0774C5.43289 10.9211 5.22093 10.8333 4.99992 10.8333ZM4.16658 17.5H2.49992V12.5H4.16658V17.5ZM18.3333 7.50001H14.9999C14.7789 7.50001 14.5669 7.5878 14.4107 7.74408C14.2544 7.90036 14.1666 8.11233 14.1666 8.33334V18.3333C14.1666 18.5544 14.2544 18.7663 14.4107 18.9226C14.5669 19.0789 14.7789 19.1667 14.9999 19.1667H18.3333C18.5543 19.1667 18.7662 19.0789 18.9225 18.9226C19.0788 18.7663 19.1666 18.5544 19.1666 18.3333V8.33334C19.1666 8.11233 19.0788 7.90036 18.9225 7.74408C18.7662 7.5878 18.5543 7.50001 18.3333 7.50001ZM17.4999 17.5H15.8333V9.16667H17.4999V17.5ZM11.6666 0.83334H8.33325C8.11224 0.83334 7.90028 0.921137 7.744 1.07742C7.58772 1.2337 7.49992 1.44566 7.49992 1.66667V18.3333C7.49992 18.5544 7.58772 18.7663 7.744 18.9226C7.90028 19.0789 8.11224 19.1667 8.33325 19.1667H11.6666C11.8876 19.1667 12.0996 19.0789 12.2558 18.9226C12.4121 18.7663 12.4999 18.5544 12.4999 18.3333V1.66667C12.4999 1.44566 12.4121 1.2337 12.2558 1.07742C12.0996 0.921137 11.8876 0.83334 11.6666 0.83334ZM10.8333 17.5H9.16658V2.50001H10.8333V17.5Z"
                                    fill="currentColor"></path>
                            </svg></span>
                        <span>{{ __('Update Race') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-card>
        <x-validation-errors class="mb-4" :errors="$errors" />
        <form wire:submit.prevent="update">
            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="px-3 mb-2">
                    <x-label for="name" :value="__('Race name')" required autofocus />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                        wire:model="race.name" required autofocus />
                    <x-input-error :messages="$errors->get('race.name')" for="name" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="category_id" :value="__('Category')" required />
                    <select
                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        id="category_id" name="category_id" wire:model="race.category_id">
                        <option value="" disabled>{{ __('Select Category') }}</option>
                        @foreach ($this->categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        <x-input-error :messages="$errors->get('race.category_id')" for="race.category_id" class="mt-2" />
                    </select>
                </div>
                <div class="px-3 mb-2">
                    <x-label for="race_location_id" :value="__('Locations')" />
                    <select id="race_location_id" name="race_location_id"
                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        wire:model="race.race_location_id">
                        <option value="" disabled>{{ __('Select Location') }}</option>
                        @foreach ($this->raceLocations as $racelocation)
                            <option value="{{ $racelocation->id }}">{{ $racelocation->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('race.race_location_id')" for="race_location_id" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="price" :value="__('Price')" required />
                    <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                        wire:model="race.price" required />
                    <x-input-error :messages="$errors->get('price')" for="price" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="date" :value="__('Date')" required />
                    <x-date-picker id="date_id" picker="date" required name="date_id" wire:model="race.date" />
                    <x-input-error :messages="$errors->get('race.date')" for="date" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="start_registration" :value="__('Registration starts at')" required />
                    <x-date-picker id="start_registration_id" picker="date" required name="start_registration_id"
                        wire:model="race.start_registration" />
                    <x-input-error :messages="$errors->get('race.start_registration')" for="start_registration" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="end_registration" :value="__('Registration ends at')" required />
                    <x-date-picker id="end_registration_id" picker="date" required name="end_registration_id"
                        wire:model="race.end_registration" />
                    <x-input-error :messages="$errors->get('race.end_registration')" for="end_registration" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="registration_deadline" :value="__('Registration deadline')" required />
                    <x-date-picker id="registration_deadline_id" picker="date" required name="registration_deadline_id"
                        wire:model="race.registration_deadline" />
                    <x-input-error :messages="$errors->get('race.registration_deadline')" for="registration_deadline" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="number_of_days" :value="__('Number of days')" required />
                    <x-input id="number_of_days" class="block mt-1 w-full" type="number" name="number_of_days"
                        wire:model="race.number_of_days" required />
                    <x-input-error :messages="$errors->get('race.number_of_days')" for="number_of_days" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="elevation_gain" :value="__('Elevation gain')" required />
                    <x-input id="elevation_gain" class="block mt-1 w-full" type="text" name="elevation_gain"
                        wire:model="race.elevation_gain" required />
                    <x-input-error :messages="$errors->get('race.elevation_gain')" for="elevation_gain" class="mt-2" />
                </div>
                <div class="px-3 mb-2">
                    <x-label for="number_of_racers" :value="__('Number of racers')" required />
                    <x-input id="number_of_racers" class="block mt-1 w-full" type="number" name="number_of_racers"
                        wire:model="race.number_of_racers" required />
                    <x-input-error :messages="$errors->get('race.number_of_racers')" for="number_of_racers" class="mt-2" />
                </div>

                <div class="px-3 mb-2">
                    <x-checkbox-input label="{{ __('Is this the first year for your race?') }}"
                        model="{{ $race->first_year }}">
                        <x-input wire:model="race.first_year" type="text" id="first_year" class="w-full block"
                            name="first_year" />
                    </x-checkbox-input>
                </div>

                <div class="px-3 mb-2">
                    <x-label for="first_year" :value="__('Last year url')" required />
                    <x-input id="last_year_url" class="block mt-1 w-full" type="text" name="last_year_url"
                        wire:model="race.last_year_url" required />
                    <x-input-error :messages="$errors->get('race.last_year_url')" for="last_year_url" class="mt-2" />
                </div>

                <div class="col-span-full px-2">
                    <div class="space-y-4 flex flex-col items-center justify-center my-4">
                        @foreach ($courses as $index => $course)
                            <div class="flex flex-row w-full items-center space-x-4"
                                wire:key="course-{{ $index }}">
                                <div class="w-1/3">
                                    <x-label for="course_name{{ $index }}" :value="__('Course name')" />
                                    <input type="text" wire:model="courses.{{ $index }}.name"
                                        placeholder="{{ __('Course name') }}" id="course_name{{ $index }}"
                                        name="course_name"
                                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                </div>
                                <div class="w-1/3">
                                    <x-label for="course_type{{ $index }}" :value="__('Course type')" />
                                    <input type="text" wire:model="courses.{{ $index }}.type"
                                        placeholder="{{ __('Course type') }}" id="course_type{{ $index }}"
                                        name="course_type"
                                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                </div>
                                <div class="w-1/3">
                                    <x-label for="distance{{ $index }}" :value="__('Course distance')" />
                                    <input type="text" wire:model="courses.{{ $index }}.distance"
                                        placeholder="{{ __('Course distance') }}" id="distance{{ $index }}"
                                        name="course_distance"
                                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                </div>
                                <div class="w-full">
                                    <x-label for="course_content{{ $index }}" :value="__('Course content')" />
                                    <textarea wire:model="courses.{{ $index }}.content" placeholder="{{ __('Course Content') }}"
                                        class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"></textarea>
                                </div>
                                <div class="w-1/4">
                                    <x-button danger type="button" wire:click="removeCourse({{ $index }})">
                                        <i class="fa fa-trash"></i>
                                    </x-button>
                                </div>
                            </div>
                        @endforeach
                        <div class="w-full flex justify-center">
                            <x-button primary type="button" wire:click="addCourse">{{ __('Add Course') }}</x-button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full px-3 mb-6 lg:mb-0">
                <x-label for="description" :value="__('Description')" />
                <x-trix name="description" wire:model="description" wire:key="description-{{ $description }}"
                    class="mt-1" />
            </div>

            <div class="w-full px-4 my-2">
                <x-label for="images" :value="__('Images')" />
                @livewire('multiple-uploads')
            </div>

            <div x-data="{ tab: 'socialMedia' }" class="flex h-auto bg-gray-100">
                <div class="w-1/4 bg-white shadow-lg">
                    <div class="flex flex-col space-y-2 p-4">
                        <button :class="{ 'bg-blue-500 text-white': tab === 'socialMedia' }"
                            @click="tab = 'socialMedia'"
                            class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
                            type="button">{{ __('Social Media') }}
                        </button>
                        <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'sponsors' }"
                            @click="tab = 'sponsors'"
                            class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none" type="button">
                            {{ __('Sponsors') }}
                        </button>
                        <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'features' }"
                            @click="tab = 'features'"
                            class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none" type="button">
                            {{ __('Features') }}
                        </button>
                        <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'calendar' }"
                            @click="tab = 'calendar'"
                            class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none" type="button">
                            {{ __('Calendar') }}
                        </button>
                        <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'options' }"
                            @click="tab = 'options'"
                            class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none" type="button">
                            {{ __('Options') }}
                        </button>
                        <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'meta' }"
                            @click="tab = 'meta'" class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
                            type="button">
                            {{ __('Meta') }}
                        </button>
                        <!-- Add other tabs as necessary -->
                    </div>
                </div>
                <div class="w-3/4 space-y-4">
                    <div x-show="tab === 'socialMedia'">

                        <div class="w-full px-2">
                            <div class="space-y-4 flex flex-col items-center justify-center my-4">
                                @foreach ($social_media as $index => $media)
                                    <div class="flex flex-row w-full items-center space-x-4">
                                        <x-input type="text" placeholder="Social Media Name"
                                            name="social_media_name"
                                            wire:model="social_media.{{ $index }}.name" />
                                        <x-input type="text" placeholder="Social Media Link"
                                            name="social_media_link"
                                            wire:model="social_media.{{ $index }}.value" />
                                        <x-button danger type="button"
                                            wire:click="removeSocialMedia({{ $index }})">
                                            <i class="fa fa-trash"></i>
                                        </x-button>
                                    </div>
                                @endforeach
                                <x-button primary type="button" wire:click="addSocialMedia">
                                    {{ __('Add Social Media') }}</x-button>
                            </div>
                        </div>
                    </div>
                    <div x-show="tab === 'sponsors'">

                        <div class="w-full px-2">
                            <div class="space-y-4 flex flex-col items-center justify-center my-4">
                                @foreach ($sponsors as $index => $sponsor)
                                    <div class="flex flex-row w-full items-center space-x-4">
                                        <input type="text" wire:model="sponsors.{{ $index }}.name"
                                            placeholder="Sponsor Name"
                                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                        <input type="text" wire:model="sponsors.{{ $index }}.image"
                                            placeholder="Sponsor Image"
                                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                        <input type="text" wire:model="sponsors.{{ $index }}.link"
                                            placeholder="Sponsor Link"
                                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                        <x-button danger type="button"
                                            wire:click="removeSponsor({{ $index }})">
                                            <i class="fa fa-trash"></i>
                                        </x-button>
                                    </div>
                                @endforeach
                                <x-button primary type="button" wire:click="addSponsor">{{ __('Add Sponsor') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                    <div x-show="tab === 'features'">

                        <div class="w-full px-2">
                            <div class="space-y-4 flex flex-col items-center justify-center my-4">
                                @foreach ($features as $index => $feature)
                                    <div class="flex flex-row w-full items-center space-x-4">
                                        <input type="text" wire:model="features.{{ $index }}"
                                            placeholder="Feature Name"
                                            class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                        <x-button danger type="button"
                                            wire:click="removeFeature({{ $index }})">
                                            <i class="fa fa-trash"></i>
                                        </x-button>
                                    </div>
                                @endforeach
                                <x-button primary type="button" wire:click="addFeature">
                                    {{ __('Add Feature') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                    <div x-show="tab === 'calendar'">

                        <div class="w-full px-2">
                            @foreach ($calendar as $index => $day)
                                <div>
                                    <div class="flex flex-wrap space-x-2 py-4 justify-center">
                                        <input type="text" wire:model="calendar.{{ $index }}.date"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md"
                                            placeholder="Date (dd/mm)">
                                        <x-button type="button" danger
                                            wire:click="removeRaceDate('{{ $index }}')">
                                            <i class="fa fa-trash"></i>
                                        </x-button>
                                    </div>
                                    <div clas="w-full flex flex-wrap justify-center space-x-2">
                                        @foreach ($day['events'] as $eventIndex => $event)
                                            <div class="flex flex-row w-full items-center space-x-4">
                                                <input type="text"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                                    wire:model.defer="calendar.{{ $index }}.events.{{ $eventIndex }}.start_time"
                                                    placeholder="Start Time">
                                                <input type="text"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                                    wire:model.defer="calendar.{{ $index }}.events.{{ $eventIndex }}.end_time"
                                                    placeholder="End Time">
                                                <input type="text"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                                    wire:model.defer="calendar.{{ $index }}.events.{{ $eventIndex }}.activity"
                                                    placeholder="Activity">
                                                <x-button type="button" danger
                                                    wire:click="removeRaceEvent('{{ $index }}', {{ $eventIndex }})">
                                                    <i class="fa fa-trash"></i>
                                                </x-button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-center py-4">
                                        <x-button secondary type="button" class="text-center"
                                            wire:click="addRaceEvent('{{ $index }}')"> Add Date +
                                        </x-button>
                                    </div>
                                </div>
                            @endforeach

                            <div class="flex justify-center mb-4">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                    type="button" wire:click="addRaceDate">{{ __('Add Race Date') }}</button>
                            </div>
                        </div>
                    </div>
                    <div x-show="tab === 'options'">

                        <div class="w-full px-2">
                            <livewire:admin.race.options />
                        </div>
                    </div>
                    <div x-show="tab === 'meta'">

                        <div class="px-2">
                            <x-label for="meta_title" :value="__('Meta Title')" />
                            <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                                wire:model="race.meta_title" />
                            <x-input-error :messages="$errors->get('race.meta_title')" for="meta_title" class="mt-2" />
                        </div>

                        <div class="px-2">
                            <x-label for="meta_description" :value="__('Meta description')" />
                            <x-input id="meta_description" class="block mt-1 w-full" type="text"
                                name="meta_description" wire:model="race.meta_description" />
                            <x-input-error :messages="$errors->get('race.meta_description')" for="meta_description" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>


            <div class="w-full px-4 my-6">
                <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </x-card>
</div>
