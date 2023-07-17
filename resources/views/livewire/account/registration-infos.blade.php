<div>
    <h2 class="text-2xl font-bold font-heading text-gray-700 mb-4">
        {{ __('Registration Information') }}
    </h2>

    <div class="flex flex-wrap transition-all duration-500 relative" x-data="{
        expadedRegistration: false,
    }">
        @foreach ($registrations as $registration)
            <div class="flex-shrink-0 px-4 lg:px-1 w-full lg:w-1/2">
                <div class="relative py-9 px-16 h-full bg-white rounded-3xl">
                    <h3 class="font-heading mb-4 text-3xl md:text-4xl font-bold leading-tighter">
                        {{ $registration->race->name }}
                        <small>{{ Helpers::format_date($registration->registration_date) }}</small>
                    </h3>
                    <a @click="expadedRegistration = {{ $registration->Id }}"
                        class="absolute -bottom-6 right-10 w-12 h-12 bg-green-500 rounded-full cursor-pointer flex items-center justify-center">
                        <i class="fas fa-arrow-down text-white"></i>
                    </a>
                    <ul x-show="expadedRegistration === {{ $registration->Id }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="py-10 mt-6 border-t border-gray-200">

                        <li>
                            <span class="font-bold">{{ __('Race name') }}:</span>
                            <span>{{ $registration->race->name }}</span>
                        </li>

                        <li>
                            <span class="font-bold">{{ __('Participant name') }}:</span>
                            <span>{{ $registration->participant->name }}</span>
                        </li>

                        <li>
                            <span class="font-bold">{{ __('Status') }}:</span>
                            <span>{{ $registration->status }}</span>
                        </li>

                        <li>
                            <span class="font-bold">{{ __('Date') }}:</span>
                            <span>{{ Helpers::format_date($registration->date) }}</span>
                        </li>

                        <li>
                            <span class="font-bold">{{ __('Additional Informations') }}:</span>
                            <span>{{ $registration->additional_informations }}</span>
                        </li>

                        <li>
                            <span class="font-bold">{{ __('Additional Services') }}:</span>
                            <span>{{ $registration->additional_services }}</span>
                        </li>

                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
