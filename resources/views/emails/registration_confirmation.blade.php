<x-mail::message>
# Registration Confirmation

Dear {{ $user->name }},

Your registration has been successful. Here are your registration details:

- Name: {{ $user->name }}
- Email: {{ $user->email }}
- Password: {{ $password }}

Please keep this password secure and change it after logging in.

Thank you for registering.

<x-mail::button :url="$url" color="success">
Login
</x-mail::button>

</x-mail::message>