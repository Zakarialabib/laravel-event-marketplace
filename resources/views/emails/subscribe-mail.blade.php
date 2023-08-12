@component('mail::message')
# {{ __('Dear') }} {{ $subscriber->name }},

<p>
{{__('Thank you for subscribing to our newsletter! We are thrilled to have you as part of our community. You will now receive
the latest news and exclusive offers directly to your inbox.')}}
</p>

{{__('Here are your subscription details:')}}

- **{{__('Name')}}:** {{ $subscriber->name }}
- **{{__('Email')}}:** {{ $subscriber->email }}
- **{{__('Subscription Date')}}:** {{ $subscriber->created_at->format('F d, Y') }}

{{__('If you ever wish to unsubscribe, simply click the "Unsubscribe" link at the bottom of our emails.')}}

{{__('Best regards,')}}
@endcomponent
