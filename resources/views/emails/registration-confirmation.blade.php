<x-mail::message>
# {{__('Registration Confirmation')}}

{{__('Dear')}} {{ $user->name }},

{{__('Your registration has been successful. Here are your registration details:')}}

- {{__('Name')}}: {{ $user->name }}
- {{__('Email')}}: {{ $user->email }}

{{__('Please keep this information secure and change your password after logging in.')}}

{{__('Thank you for registering.')}}

@component('mail::button', ['url' => $url, 'color' => 'success'])
{{__('Login')}}
@endcomponent

</x-mail::message>