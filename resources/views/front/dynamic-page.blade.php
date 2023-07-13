@section('title', $page->title)
<x-app-layout>
    <section class="relative table w-full bg-gray-100 pt-16 pb-24">
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-8 mt-10">
            <img src="{{ $page->getFirstMediaUrl('local_files') }}" alt="{{ $page->title }}"
                class="object-cover object-top w-full" />
            <h1 class="mt-6 text-3xl text-center font-bold text-black md:text-5xl">
                {{ $page->title }}
            </h1>
            <p class="py-10 text-black">{!! $page->description !!}</p>
        </article>
    </section>
    <section class="py-14 dark:bg-white/[0.03] lg:py-20">
        <div class="px-6">
            <div class="w-full flex flex-col items-center justify-center mb-4">
                <div class="heading text-center rtl:lg:text-right">
                    <h6
                        class="text-3xl font-bold sm:!leading-[50px] heading text-center rtl:lg:text-right !text-indigo-600">
                        {{ __('Resources') }}</h6>
                    <h4>{{ __('Unlock the latest trends/news') }}</h4>
                </div>
            </div>
            <div
                class="Swiper blog-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                <div class="swiper-wrapper">
                    @foreach (\App\Helpers::getActiveBlogs() as $blog)
                        <div class="rounded-3xl bg-white dark:bg-gray-dark">
                            <img src="assets/images/modern-saas/marketing.png" alt="blog-3"
                                class="h-52 w-full rounded-t-3xl object-cover">
                            <div class="p-5 text-sm font-bold">
                                <span
                                    class="rounded bg-indigo-600/10 py-1 px-2 text-sm font-extrabold text-indigo-600">Marketing</span>
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="my-[10px] block text-lg font-extrabold leading-[23px] text-black transition line-clamp-2 hover:text-indigo-800 dark:text-white dark:hover:text-indigo-800">
                                    {{ $blog->title }}
                                </a>
                                <p class="line-clamp-3">
                                    {!! $blog->description !!}
                                </p>
                                <div class="mt-6 flex items-center justify-between text-indigo-800">
                                    <span>
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </span>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="transition hover:text-indigo-600">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M25.4091 13.0009C25.4091 19.8539 19.8531 25.41 13 25.41C6.14699 25.41 0.590937 19.8539 0.590937 13.0009C0.590937 6.14785 6.14699 0.591797 13 0.591797C19.8531 0.591797 25.4091 6.14785 25.4091 13.0009ZM12.7226 7.55043C12.6336 7.63872 12.5628 7.74368 12.5144 7.85931C12.466 7.97495 12.4408 8.09899 12.4403 8.22436C12.4398 8.34973 12.464 8.47398 12.5115 8.58999C12.559 8.70601 12.6289 8.81153 12.7172 8.90052L15.8386 12.0463H7.86935C7.61618 12.0463 7.37339 12.1469 7.19438 12.3259C7.01537 12.5049 6.9148 12.7477 6.9148 13.0009C6.9148 13.254 7.01537 13.4968 7.19438 13.6759C7.37339 13.8549 7.61618 13.9554 7.86935 13.9554H15.8386L12.7172 17.1013C12.6289 17.1903 12.5591 17.2959 12.5116 17.412C12.4641 17.5281 12.4399 17.6524 12.4405 17.7778C12.441 17.9033 12.4663 18.0273 12.5148 18.143C12.5633 18.2587 12.6341 18.3636 12.7232 18.4519C12.8123 18.5402 12.9179 18.6101 13.034 18.6576C13.1501 18.7051 13.2744 18.7292 13.3998 18.7287C13.5252 18.7281 13.6493 18.7029 13.765 18.6544C13.8806 18.6059 13.9856 18.5351 14.0739 18.446L18.8102 13.6732C18.9876 13.4944 19.0872 13.2528 19.0872 13.0009C19.0872 12.749 18.9876 12.5073 18.8102 12.3285L14.0739 7.5558C13.9856 7.46661 13.8806 7.39571 13.7648 7.34716C13.6491 7.29861 13.5249 7.27336 13.3994 7.27286C13.2739 7.27236 13.1495 7.29662 13.0333 7.34425C12.9172 7.39188 12.8116 7.46194 12.7226 7.55043Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
