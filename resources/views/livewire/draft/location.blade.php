<section class="h-auto bg-gray-50 text-black md:px-4 lg:px-10 py-4 md:py-6 lg:py-10">
    <h5
        class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tight font-extrabold text-black cursor-pointer pb-10 text-center">
        {{ __('Races Locations') }}
    </h5>
    <hr>
    <div class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 gap-6 mt-4 px-5">
        @foreach ($this->raceLocations as $raceLocation)
            <div class="float-left mx-3">
                <figure class="text-gray-700 flex break-words">
                    <div
                        class="items-center clear-both flex flex-col float-left justify-start my-3.5 pb-8 text-center">
                        <div class="float-left mb-3 w-full">
                            <img src="{{ $raceLocation->getFirstMediaUrl('local_files') }}"
                                class="h-96 w-full transition-all duration-300">
                            <ul
                                class="flex flex-col bg-red-600 text-white cursor-pointer py-5 px-8 gap-y-2 text-center">
                                <li class="text-lg font-bold">
                                    {{ $raceLocation->name }}
                                </li>
                                <li class="text-md tracking-tighter">
                                    {!! $raceLocation->description !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                </figure>
            </div>
        @endforeach
    </div>
</section>