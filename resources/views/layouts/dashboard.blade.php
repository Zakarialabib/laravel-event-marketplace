<!DOCTYPE html>
<html x-data="mainState" class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title') || {{ settings('site_title') }}
    </title>
    <!-- Styles -->

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/' . settings('site_favicon')) }}" type="image/x-icon">

    @include('partials.admin.css')

</head>

<body class="antialiased bg-gray-50 text-body font-body">
    <x-loading-mask />
    <div @resize.window="handleWindowResize">
        <div class="min-h-screen">
            <!-- Sidebar -->
            <x-sidebar.sidebar />
            <!-- Page Wrapper -->
            <div class="flex flex-col min-h-screen"
                :class="{
                    'lg:ml-64': isSidebarOpen,
                    'lg:ml-16': !isSidebarOpen,
                }"
                style="transition-property: margin; transition-duration: 150ms;">

                <!-- Navigation Bar-->
                <x-navbar />

                <main class="pt-2 flex-1 px-6">
                    @yield('content')
                    @isset($slot)
                        {{ $slot }}
                    @endisset
                </main>

                <!-- Footer -->
                <x-copyright />

            </div>
        </div>
    </div>
    
    @vite('resources/js/app.js')
    @include('partials.admin.js')

</body>

</html>
