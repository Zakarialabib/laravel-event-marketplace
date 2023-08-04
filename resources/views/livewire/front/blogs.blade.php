<div>
    @section('title', __('Resources'))

    <section class="relative pt-16 bg-white">
        <div class="items-center w-full  max-w-7xl mx-auto">
            <h1
                class="text-5xl md:text-6xl lg:text-7xl px-10 text-center leading-tight text-green-600 font-bold tracking-tighter mt-20 cursor-pointer">
                <span class="hover:underline transition duration-200 ease-in-out uppercase">{{ __('Resources') }}</span>
            </h1>
            <p class="text-2xl font-light text-gray-400 text-center my-4">{{ __('Browse the latest news & resources') }}
            </p>
            <div class="container mx-auto py-4">
                <div class="flex justify-center gap-4 mt-2">
                    <button
                        class="px-4 py-2 text-sm font-semibold text-green-500 border-2 border-green-500 rounded-full hover:bg-green-500 hover:text-white focus:outline-none focus:bg-green-500 focus:text-white"
                        wire:click="$emit('categorySelected', null)">
                        {{ __('All') }}
                    </button>
                    @foreach ($this->categories as $category)
                        <button
                            class="px-4 py-2 text-sm font-semibold text-green-500 border-2 border-green-500 rounded-full hover:bg-green-500 hover:text-white focus:outline-none focus:bg-green-500 focus:text-white"
                            wire:click="$emit('categorySelected', {{ $category->id }})">
                            {{ $category->title }}
                        </button>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3 items-center">
                    @forelse ($blogs as $blog)
                        <a href="{{ route('front.blogPage', $blog->slug) }}">
                            <div
                                class="text-center border-4 border-green-600 text-green-400 hover:bg-green-400 hover:text-green-800 transition duration-300 max-w-sm rounded overflow-hidden shadow-lg py-10 px-8">
                                <h2 class="text-center uppercase mb-3 font-semibold">{{ $blog->title }}</h2>
                                <p class="mb-2 text-sm text-gray-600">{!! $blog->content !!}</p>

                                <img src="{{ $blog->getFirstMediaUrl('blog') }}" class="w-100"
                                    alt="{{ $blog->title }}">
                            </div>
                        </a>
                    @empty
                        <div class="text-center">
                            <p>{{ __('No entries found.') }}</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>

        @if (count($this->featured_blogs) > 0)
            <div class="relative py-6 mx-auto px-6 bg-green-50 ">
                <h2 class="mb-10 font-heading text-4xl md:text-5xl xl:text-6xl leading-tight">
                    {{ 'Featured Articles' }}
                </h2>
                <div class="flex flex-wrap justify-center gap-4 py-6">
                    @foreach ($this->featured_blogs as $blog)
                        <div class="w-full xl:w-1/4 px-4 bg-white py-6">
                            <div class="flex flex-wrap items-center">
                                <a href="{{ route('front.blogPage', $blog->slug) }}" class="w-full">
                                    <img alt="{{ $blog->title }}" src="{{ $blog->getFirstMediaUrl('blog') }}"
                                        class="shadow-lg rounded max-w-full h-auto align-middle border-none" />
                                </a>
                                <div class="w-full px-4 mx-auto text-center mt-4">
                                    <h3 class="text-3xl mb-2 font-semibold leading-normal">
                                        {{ $blog->title }}
                                    </h3>
                                    <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                                        {!! $blog->description !!}
                                    </p>
                                    <a href="{{ route('front.blogPage', $blog->slug) }}"
                                        class="bottom-0 block text-center cursor-pointer border-2 border-green-600 py-2 text-sm front-bold text-green-600 transition ease-in-out duration-300 hover:bg-green-800 hover:text-green-100 focus:bg-green-800 font-semibold uppercase">{{ __('Read More') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if (count($this->sections) > 0)
            <section class="py-5 px-10 mx-auto bg-gray-100">
                @foreach ($this->sections as $section)
                    <div class="px-3 relative h-full text-center py-16 bg-white">
                        <div class="pb-12 border-b">
                            <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                            @if ($section->subtitle)
                                <p>{{ $section->subtitle }}</p>
                            @endif
                        </div>
                        <div class="py-5 px-4 text-center">
                            <p class="text-lg text-gray-500">
                                {!! $section->description !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </section>
        @endif
    </section>
</div>
