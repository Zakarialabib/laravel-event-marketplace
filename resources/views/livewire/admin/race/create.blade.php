<div>
    <!-- Create Modal -->
    <x-modal wire:model="createModal" wire:init="openModal">
        <x-slot name="title">
            {{ __('Create Race') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <x-validation-errors class="mb-4" :errors="$errors" />
                <form wire:submit.prevent="create">
                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="name" :value="__('Race Name')" required autofocus />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                wire:model="race.name" required autofocus />
                            <x-input-error :messages="$errors->get('race.name')" for="name" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="start_registration" :value="__('Registration starts at')" required />
                            <x-date-picker id="start_registration" picker="date" name="start_registration"
                                wire:model="race.start_registration" />
                            <x-input-error :messages="$errors->get('race.start_registration')" for="start_registration" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="end_registration" :value="__('Registration ends at')" required />
                            <x-date-picker id="end_registration" picker="date" name="end_registration"
                                wire:model="race.end_registration" />
                            <x-input-error :messages="$errors->get('race.end_registration')" for="end_registration" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="registration_deadline" :value="__('Registration deadline')" required />
                            <x-date-picker id="registration_deadline" picker="date" name="registration_deadline"
                                wire:model="race.registration_deadline" />
                            <x-input-error :messages="$errors->get('race.registration_deadline')" for="registration_deadline" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="number_of_days" :value="__('Number of days')" required />
                            <x-input id="number_of_days" class="block mt-1 w-full" type="number" name="number_of_days"
                                wire:model="race.number_of_days" required />
                            <x-input-error :messages="$errors->get('race.number_of_days')" for="number_of_days" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="elevation_gain" :value="__('Elevation gain')" required />
                            <x-input id="elevation_gain" class="block mt-1 w-full" type="text" name="elevation_gain"
                                wire:model="race.elevation_gain" />
                            <x-input-error :messages="$errors->get('race.elevation_gain')" for="elevation_gain" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="number_of_racers" :value="__('Number of racers')" required />
                            <x-input id="number_of_racers" class="block mt-1 w-full" type="number"
                                name="number_of_racers" wire:model="race.number_of_racers" required />
                            <x-input-error :messages="$errors->get('race.number_of_racers')" for="number_of_racers" class="mt-2" />
                        </div>
                        <x-checkbox-input label="{{ __('Is this the first year for your race?') }}" model="first_year">
                            <x-input wire:model="race.first_year" type="text" id="first_year"
                                class="w-full block" name="first_year" />
                        </x-checkbox-input>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="first_year" :value="__('Last year url')" required />
                            <x-input id="last_year_url" class="block mt-1 w-full" type="text"
                                name="last_year_url" wire:model="race.last_year_url" required />
                            <x-input-error :messages="$errors->get('race.last_year_url')" for="last_year_url" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="category_id" :value="__('Category')" required />
                            <select
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="category_id" name="category_id" wire:model="race.category_id">
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <x-input-error :messages="$errors->get('race.category_id')" for="race.category_id" class="mt-2" />
                            </select>
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
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

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="price" :value="__('Price')" required />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                wire:model="race.price" required />
                            <x-input-error :messages="$errors->get('price')" for="price" class="mt-2" />

                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="date" :value="__('Date')" required />
                            <x-date-picker id="race-date" picker="date" name="race-date" required
                                wire:model="race.date" />
                            <x-input-error :messages="$errors->get('race.date')" for="date" class="mt-2" />
                        </div>


                        <div class="w-full px-3 mb-6 lg:mb-0">
                            <x-label for="description" :value="__('Description')" />
                            <x-trix name="description" wire:model="description" class="mt-1" />

                        </div>

                        <div class="w-full px-4 my-2">
                            <x-label for="image" :value="__('Race Image')" />
                            <x-media-upload title="{{ __('Race Image') }}" name="image" wire:model="image"
                                :file="$image" single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                        </div>
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
                                    class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
                                    type="button">
                                    {{ __('Sponsors') }}
                                </button>
                                <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'features' }"
                                    @click="tab = 'features'"
                                    class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
                                    type="button">
                                    {{ __('Features') }}
                                </button>
                                <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'calendar' }"
                                    @click="tab = 'calendar'"
                                    class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
                                    type="button">
                                    {{ __('Calendar') }}
                                </button>
                                <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'courses' }"
                                    @click="tab = 'courses'"
                                    class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
                                    type="button">
                                    {{ __('Courses') }}
                                </button>
                                <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'options' }"
                                    @click="tab = 'options'"
                                    class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
                                    type="button">
                                    {{ __('Options') }}
                                </button>
                                <button type="button" :class="{ 'bg-blue-500 text-white': tab === 'meta' }"
                                    @click="tab = 'meta'"
                                    class="py-2 px-4 text-gray-800 w-full rounded-lg focus:outline-none"
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
                                            <div class="flex flex-row w-full items-center space-x-4"
                                                wire:key="social-media-{{ $index }}">
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
                                            <div class="flex flex-row w-full items-center space-x-4"
                                                wire:key="sponsor-{{ $index }}">
                                                <input type="text" wire:model="sponsors.{{ $index }}.name"
                                                    placeholder="Sponsor Name" id="sponsor{{ $index }}name"
                                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                                <input type="text" wire:model="sponsors.{{ $index }}.image"
                                                    placeholder="Sponsor Image" id="sponsor{{ $index }}image"
                                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                                <input type="text" wire:model="sponsors.{{ $index }}.link"
                                                    placeholder="Sponsor Link" id="sponsor{{ $index }}link"
                                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                                <x-button danger type="button"
                                                    wire:click="removeSponsor({{ $index }})">
                                                    <i class="fa fa-trash"></i>
                                                </x-button>
                                            </div>
                                        @endforeach
                                        <x-button primary type="button"
                                            wire:click="addSponsor">{{ __('Add Sponsor') }}
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
                                        <div class="flex flex-col gap-4 items-center py-4 justify-center"
                                            wire:key="day-{{ $index }}">
                                            <input type="text" wire:model="calendar.{{ $index }}.date"
                                                id="date-{{ $index }}"
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md"
                                                placeholder="Date (dd/mm)">
                                            <x-button type="button" danger
                                                wire:click="removeRaceDate('{{ $index }}')">
                                                <i class="fa fa-trash"></i>
                                            </x-button>
                                        </div>
                                        <div clas="w-full flex flex-wrap justify-center gap-2">
                                            @foreach ($day['events'] as $eventIndex => $event)
                                                <div class="w-full my-auto gap-4"
                                                    wire:key="event-{{ $index }}-{{ $eventIndex }}">
                                                    <input type="text"
                                                        id="start-time-{{ $index }}-{{ $eventIndex }}"
                                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                                        wire:model="calendar.{{ $index }}.events.{{ $eventIndex }}.start_time"
                                                        placeholder="Start Time">
                                                    <input type="text"
                                                        id="end-time-{{ $index }}-{{ $eventIndex }}"
                                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                                        wire:model="calendar.{{ $index }}.events.{{ $eventIndex }}.end_time"
                                                        placeholder="End Time">
                                                    <input type="text"
                                                        id="activity-{{ $index }}-{{ $eventIndex }}"
                                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                                        wire:model="calendar.{{ $index }}.events.{{ $eventIndex }}.activity"
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
                                    @endforeach

                                    <div class="flex justify-center mb-4">
                                        <x-button type="button" primary
                                            wire:click="addRaceDate">{{ __('Add Race Date') }}</x-button>
                                    </div>
                                </div>
                            </div>
                            <div x-show="tab === 'courses'">
                                <div class="w-full px-2">
                                    <div class="space-y-4 flex flex-col items-center justify-center my-4">
                                        @foreach ($courses as $index => $course)
                                            <div class="flex flex-wrap w-full items-center gap-4"
                                                wire:key="course-{{ $index }}">
                                                <input type="text" wire:model="courses.{{ $index }}.name"
                                                    placeholder="{{ __('Course name') }}"
                                                    id="course_name{{ $index }}" name="course_name"
                                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                                <input type="text" wire:model="courses.{{ $index }}.type"
                                                    placeholder="{{ __('Course type') }}"
                                                    id="course_type{{ $index }}" name="course_type"
                                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                                <input type="text"
                                                    wire:model="courses.{{ $index }}.distance"
                                                    placeholder="{{ __('Course distance') }}"
                                                    id="distance{{ $index }}" name="course_distance"
                                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                                                <textarea wire:model="courses.{{ $index }}.content" placeholder="{{ __('Course Content') }}"
                                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"></textarea>
                                                <x-button danger type="button"
                                                    wire:click="removeCourse({{ $index }})">
                                                    <i class="fa fa-trash"></i>
                                                </x-button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-center mb-4">
                                        <x-button primary type="button" wire:click="addCourse">
                                            {{ __('Add Course') }}
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                            <div x-show="tab === 'options'">
                                <div class="w-full px-2">
                                    <livewire:admin.race.options />
                                </div>
                            </div>
                            <div x-show="tab === 'meta'">

                                <div class="w-full px-2">
                                    <x-label for="meta_title" :value="__('Meta Title')" />
                                    <x-input id="meta_title" class="block mt-1 w-full" type="text"
                                        name="meta_title" wire:model="race.meta_title" />
                                    <x-input-error :messages="$errors->get('race.meta_title')" for="meta_title" class="mt-2" />
                                </div>

                                <div class="w-full px-2">
                                    <x-label for="meta_description" :value="__('Meta Description')" />
                                    <x-input id="meta_description" class="block mt-1 w-full" type="text"
                                        name="meta_description" wire:model="race.meta_description" />
                                    <x-input-error :messages="$errors->get('race.meta_description')" for="meta_description" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col w-full px-4 my-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="status" type="checkbox"
                                    class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out"
                                    wire:model="race.status">
                                <x-label for="status" class="ml-2 block text-sm leading-5 text-gray-900">
                                    {{ __('Create as Inactive') }}
                                </x-label>
                            </div>
                            <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
