<section class="w-full bg-green-50 py-12 lg:ml-auto bg-opacity-80">
    <h3 class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tight font-extrabold text-black cursor-pointer pb-10 text-center">
        {{ __('Sponsors') }}
    </h3>
    <div class="flex flex-wrap items-center justify-center -mx-2 -mb-12 gap-x-6">
        @foreach ($this->sponsors as $sponsor)
            <div class="w-1/4 sm:w-1/2 md:w-1/3 lg:w-1/6 px-2 mb-12">
                <img class="mx-auto w-56 h-auto my-4 filter grayscale transition duration-300 hover:grayscale-0"
                    src="{{ $sponsor->getFirstMediaUrl('local_files') }}" alt="{{ $sponsor->name }}">
                <p
                    class="text-center text-sm px-4 mb-4 absolute bottom-0 left-0 w-full text-white text-opacity-0 group-hover:text-opacity-100 transition-opacity duration-300 cursor-pointer">
                    {{ $sponsor->name }}
                </p>
            </div>
        @endforeach
    </div>
</section>