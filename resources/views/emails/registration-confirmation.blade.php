@component('mail::message')
# {{ __('Dear') }} {{ $participant->name }},


{{ __('Your registration has been successful. Here are your registration details:') }}

- {{ __('Name') }}: {{ $participant->name }}
- {{ __('Email') }}: {{ $participant->email }}
- {{ __('Phone number') }}: {{ $participant->phone_number }}

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{__('Go to My Account')}}
@endcomponent

{{ __('Please keep this information secure and change your password after logging in.') }}

{{ __('Thank you for registering.') }}
@endcomponent

