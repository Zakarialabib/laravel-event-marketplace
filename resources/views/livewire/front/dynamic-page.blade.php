<div>
    @section('title', $page->title)
    
    <section class="relative table w-full bg-gray-100 pt-16 pb-24">
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-8 mt-10">
            <img src="{{ $page->getFirstMediaUrl('local_files') }}" alt="{{ $page->title }}"
                class="object-cover object-top w-full" />
            <h1 class="mt-6 text-3xl text-center font-bold text-black md:text-5xl">
                {{ $page->title }}
            </h1>
            <p class="py-10 text-black">{!! $page->details !!}</p>
        </article>
    </section>
</div>
