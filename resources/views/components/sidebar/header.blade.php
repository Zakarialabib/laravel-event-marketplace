<div class="flex items-center justify-between flex-shrink-0 px-3">
    <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold">
        <img class="w-14 h-auto" src="{{ asset('images/' . settings('site_logo')) }}"
            alt="{{ settings('site_title') }}">
        <span class="sr-only">
            {{ settings('site_title') }}
        </span>
    </a>
</div>
