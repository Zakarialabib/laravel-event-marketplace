<!DOCTYPE html>
<html x-data="mainState" class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title') || {{ Helpers::settings('site_title') }}
    </title>
    <!-- Styles -->

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/' . Helpers::settings('site_favicon')) }}" type="image/x-icon">

    @include('partials.front.css')

</head>

<body class="antialiased bg-gray-50 text-body font-body">
    
    <x-loading-mask />       

    <main class="pt-5 flex-1">
        @yield('content')
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>

    <!-- Footer -->
    <x-copyright />

    @include('partials.front.js')

</body>

</html>
