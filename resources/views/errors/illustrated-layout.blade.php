<!DOCTYPE html>
<html x-data="mainState" class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Head Tags -->
    @if (settings('head_tags'))
        {!! settings('head_tags') !!}
    @endif

    <title>
        @yield('title') || {{ settings('site_title') }}
    </title>
 
    <link rel="icon" href="{{ asset('images/' . settings('site_favicon')) }}" type="image/x-icon">

    <!-- Styles -->
    @include('partials.front.css')

</head>

<body class="antialiased font-sans">
    <!-- Body Tags -->
    @if (settings('body_tags'))
        {!! settings('body_tags') !!}
    @endif

    <x-header />

    <section class="relative py-24 md:py-44 lg:py-64 bg-white">
        <div class="relative z-10 px-4 mx-auto">
            <div class="max-w-4xl mx-auto text-center">
                <span
                    class="inline-block py-px px-2 mb-4 text-xs leading-5 text-green-500 bg-green-100 font-medium rounded-full shadow-sm">@yield('code', __('Oh no'))</span>
                <h2 class="mb-4 text-4xl md:text-5xl leading-tight font-bold tracking-tighter">
                    {{ __('Page not found') }}</h2>
                <p class="mb-12 text-lg md:text-xl text-gray-500">@yield('message')</p>
                <div class="flex flex-wrap justify-center">
                    <div class="w-full md:w-auto py-1">
                        <x-button primary
                            class="inline-block py-5 px-7 w-full text-base md:text-lg leading-4 text-green-50 font-medium text-center bg-green-500 hover:bg-green-600 focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 border border-green-500 rounded-md shadow-sm"
                            href="{{ app('router')->has('dashboard') ? route('dashboard') : url('/') }}">
                            {{ __('Go back to Homepage') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-theme.footer />
    @include('partials.front.js')
</body>

</html>
