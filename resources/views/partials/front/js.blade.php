
@vite('resources/js/app.js')

@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts />

@stack('scripts')

{{-- <x-core-web-vital-core-web-component /> --}}
