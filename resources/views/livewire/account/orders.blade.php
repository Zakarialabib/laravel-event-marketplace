<div>
    <h2 class="text-2xl font-bold font-heading text-gray-700 mb-4">
        {{ __('Orders') }}
    </h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($this->orders as $order)
            <div class="px-4 shadow-lg border bg-white">
                <p><strong>{{ __('Order Reference') }}:</strong> {{ $order->reference }}</p>
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
                <p><strong>{{ __('Order Amount') }}:</strong> {{ $order->amount }}</p>
                <p><strong>{{ __('Payment Method') }}:</strong> {{ $order->payment_method }}</p>
                <p><strong>{{ __('Order Status') }}:</strong> {{ $order->status }}</p>
                <p><strong>{{ __('Payment Status') }}:</strong> {{ $order->payment_status }}</p>
                <p><strong>{{ __('Order Date') }}:</strong> {{ $order->created_at }}</p>
            </div>
        @endforeach
    </div>
</div>
