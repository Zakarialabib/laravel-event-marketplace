<div>
    <div class="container mx-auto px-4 py-24">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex my-4 items-center">
                <h2 class="text-4xl font-bold font-heading">{{ __('Thank you for your order') }}</h2>
            </div>
            <div class="flex">
                <div class="w-1/2 pr-4 border-r">
                    <h3 class="text-left text-lg font-semibold mb-2">{{ __('Order Details') }}</h3>
                    <p><strong>{{ __('Reference') }}:</strong> {{ $order->reference }}</p>
                    @if ($order->race)
                        <p><strong>{{ __('Race') }}:</strong> <a
                                href="{{ route('front.raceDetails', $order->race->slug) }}">{{ $order->race->name }}</a>
                        </p>
                    @endif
                    @if ($order->service)
                        <p><strong>{{ __('Service') }}:</strong> 
                            <a href="#">{{ $order->service->name }}</a>
                        </p>
                    @endif
                    @if ($order->product)
                        <p>
                            <strong>{{ __('Product') }}:</strong> 
                            <a href="{{ route('front.product', $order->product->slug) }}">
                                {{ $order->product->name }}
                            </a>
                        </p>
                    @endif
                    <p><strong>{{ __('Order Amount') }}:</strong> {{ Helpers::format_currency($order->amount) }}</p>
                    <p><strong>{{ __('Payment Method') }}:</strong> {{ $order->payment_method }}</p>
                    <p><strong>{{ __('Order Status') }}:</strong> {{ $order->status->getName() }}</p>
                    <p><strong>{{ __('Payment Status') }}:</strong> {{ $order->payment_status->getName() }}</p>
                    <p><strong>{{ __('Order Date') }}:</strong> {{ Helpers::format_date($order->created_at) }}</p>
                </div>
                <div class="w-1/2 pl-4">
                    <h3 class="text-left text-lg font-semibold mb-2">{{ __('Registration Account') }}</h3>
                    <p><strong>{{ __('User Name') }}:</strong> {{ $order->user->name }}</p>
                    <p><strong>{{ __('User Email') }}:</strong> {{ $order->user->email }}</p>
                </div>
            </div>
            <div class="flex justify-center mt-6">
                <a href="{{ route('front.myaccount') }}"
                    class="bg-blue-500 text-white rounded px-6 py-2 hover:bg-blue-600 transition-colors duration-200">
                    {{ __('Go to My Account') }}
                </a>
            </div>
        </div>
    </div>
</div>
