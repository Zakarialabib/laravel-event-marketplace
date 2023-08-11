@component('mail::message')
# {{ __('Dear') }} {{ $user->name }},

{{ __('Your order has been confirmed. Here are the order details') }}:

**{{ __('Order Reference') }}:** {{ $order->reference }}

@if ($order->race)
**{{ __('Race') }}:** [{{ $order->race->name }}]({{ route('front.raceDetails', $order->race->slug) }})
@endif

@if ($order->service)
**{{ __('Service') }}:** {{ $order->service->name }}
@endif

@if ($order->product)
**{{ __('Product') }}:** [{{ $order->product->name }}]({{ route('front.product', $order->product->slug) }})
@endif

- **{{ __('Order Amount') }}:** {{ $order->amount }}
- **{{ __('Payment Method') }}:** {{ $order->payment_method }}
- **{{ __('Order Status') }}:** {{ $order->status }}
- **{{ __('Payment Status') }}:** {{ $order->payment_status }}
- **{{ __('Order Date') }}:** {{ $order->created_at }}

@component('mail::button', ['url' => route('front.myaccount'), 'color' => 'blue'])
{{__('Go to My Account')}}
@endcomponent

@endcomponent

