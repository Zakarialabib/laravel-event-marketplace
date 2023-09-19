<div>
    @section('title', __('Home'))

    <x-topheader />

    <div class="relative mx-auto">
        <section class="w-full mx-auto bg-gray-900 h-auto relative">
            <x-theme.slider :sliders="$this->sliders" />
        </section>
        <section class="lg:px-10 sm:px-6 lg:py-16 md:py-14" x-data="{ activeTab: 0 }">
            <h3
                class="uppercase text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tight font-extrabold text-black cursor-pointer pb-6 text-center">
                {{ __('Upcoming Races') }}
            </h3>
            <div
                class="flex items-center border-t-2 border-gray-50 border-dashed gap-5 justify-center flex-wrap mx-auto w-full py-4 sm:w-[80%] xl:w-full mb-6">
                @foreach (\App\Helpers::getActiveCategories() as $category)
                    <button type="button" id="{{ $category->name }}"
                        class="text-gray-600 font-bold bg-gray-50 rounded-full border-transparent transition-all duration-200 cursor-pointer tab-item font-chivo text-sm px-5 py-[10px] text-[14px] leading-[18px] lg:text-[18px] lg:leading-[22px] lg:px-[20px] lg:py-[16px] hover:bg-transparent hover:text-red-900 border-[2px] hover:border-red-900 hover:translate-y-[-2px] 
                            {{ $category->name == $category_name ? 'bg-red-500 text-white border-red-900' : '' }}"
                        wire:click="filterType('{{ $category->name }}')">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            <div class="flex flex-wrap items-center mt-4 space-y-4" wire:loading.class.delay="opacity-50"
                wire:target="filterType">
                @forelse ($this->races as $race)
                    <div class="relative w-full px-4">
                        <x-race-card :race="$race" view="wide" />
                    </div>
                @empty
                    <div class="w-full bg-gray-50 py-10 mb-10 rounded-lg px-4 md:-mx-4 shadow-2xl">
                        <h3 class="text-3xl text-center font-bold font-heading text-blue-900">
                            {{ __('No Races found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
        </section>

        @if (count(\App\Helpers::getActiveFeaturedBlogs()) > 0)
            <div class="relative py-6 mx-auto px-6 bg-green-50 ">
                <h2
                    class="uppercase mb-6 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tight font-extrabold text-black cursor-pointer pb-10 text-center">
                    {{ 'Resources' }}
                </h2>
                <div class="grid xl:grid-cols-3 sm:grid-cols-1 gap-4 overflow-hidden justify-center py-6">
                    @foreach (\App\Helpers::getActiveFeaturedBlogs() as $blog)
                        <x-blog-card :blog="$blog" />
                    @endforeach
                </div>
            </div>
        @endif


        @if (count($this->featuredProducts) > 0)
            <section class="py-10 mx-auto px-4 text-center text-black">
                <a href="{{ route('front.catalog') }}">
                    <h2
                        class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl md:leading-normal leading-normal font-bold cursor-pointer pb-10 text-center">
                        {{ __('Visit Store') }}
                    </h2>
                </a>

                <p class="text-center mb-6">
                    {{ __('We have a wide range of products for you to choose from') }}
                </p>

                <hr>
                <div class="relative mb-6">
                    <x-product-slider :products="$this->featuredProducts" />
                </div>
            </section>
        @endif


        @if (count($this->sections) > 0)
            <section class="py-5 px-4 mx-auto bg-gray-100">
                <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                    @foreach ($this->sections as $section)
                        <div class="px-3 mb-6 relative h-full text-center pt-16 bg-white">
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
                </div>
            </section>
        @endif
    </div>
</div>
