<div>
    <div class="relative py-10 bg-gray-100">
        <div class="mt-64 lg:mt-0 py-16 bg-white">
            <div class="mx-auto px-4">
                <div class="flex items-end justify-end">
                    <div class="w-full lg:w-3/5 lg:pl-20 lg:ml-auto">
                        <h2 class="mb-8 text-5xl font-bold font-heading">{{ __('You are leaving CHRILIA') }}
                            
                        </h2>

                        <p class="mb-12 text-gray-500">
                            {{ __('You will be redirected to store website in matter of sec.') }}</p>
                        <p class="mb-12 text-gray-500">
                            {{ __('Before you go, please consider leaving a review of this product or store to help other users make informed decisions.') }}
                        </p>
                        <a class="block text-center px-8 py-4 bg-red-500 hover:bg-red-700 text-white font-bold font-heading uppercase rounded-md transition duration-200"
                            href="{{ $url }}">
                            {{ __('go without waiting') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        setTimeout(function() {
            window.location.href = "{{ $url }}";
        }, 10000);
    </script>
@endpush
