@component('mail::message')
# {{ __('You are invited to ') }} {{ $team->team_name }},


{{ __('You have been invited to join the team :team_name', ['team_name' => $team->team_name]) }}.

{{ __('If you did not expect to receive an invitation to this team, you can ignore this email.') }}

{{ __('Regards') }},<br>
@endcomponent
