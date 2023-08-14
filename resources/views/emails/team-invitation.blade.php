@component('mail::message')
# {{ __('You are invited to ') }} {{ $team->name }},


{{ __('You have been invited to join the team :name', ['name' => $team->name]) }}.

{{ __('If you did not expect to receive an invitation to this team, you can ignore this email.') }}

{{ __('Regards') }},<br>
@endcomponent
