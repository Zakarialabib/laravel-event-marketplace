@component('mail::message')
# {{ __('Dear') }} {{ $subscriber->name }},

<p>
Thank you for subscribing to our newsletter! We are thrilled to have you as part of our community. You will now receive
the latest news and exclusive offers directly to your inbox.
</p>

Here are your subscription details:

- **Name:** {{ $subscriber->name }}
- **Email:** {{ $subscriber->email }}
- **Subscription Date:** {{ $subscriber->created_at->format('F d, Y') }}

If you ever wish to unsubscribe, simply click the "Unsubscribe" link at the bottom of our emails.

Best regards,
@endcomponent
