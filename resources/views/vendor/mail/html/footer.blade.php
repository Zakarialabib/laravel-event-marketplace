<tr>
    <td
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="footer">
                    <p>&copy; {{ date('Y') }} {{ Helpers::settings('company_name') }}.
                        {{ __('All rights reserved') }}.</p>
                    <p>{{ __('Contact') }}: {{ Helpers::settings('company_email_address') }} | {{ __('Phone') }}:
                        {{ Helpers::settings('company_phone') }}</p>
                    <p>{{ __('Address') }}: {{ Helpers::settings('company_address') }}</p>


                    <p>
                        Stay connected with us:
                    </p>
                    <div style="display:flex; justify-content: center;flex-wrap: wrap; gap: 1rem">

                        @if (Helpers::settings('social_facebook'))
                            <p><a href="{{ Helpers::settings('social_facebook') }}" target="_blank">Facebook</a></p>
                        @endif
                        @if (Helpers::settings('social_twitter'))
                            <p><a href="{{ Helpers::settings('social_twitter') }}" target="_blank">Twitter</a></p>
                        @endif
                        @if (Helpers::settings('social_instagram'))
                            <p><a href="{{ Helpers::settings('social_instagram') }}" target="_blank">Instagram</a>
                            </p>
                        @endif
                        @if (Helpers::settings('social_linkedin'))
                            <p><a href="{{ Helpers::settings('social_linkedin') }}" target="_blank">LinkedIn</a></p>
                        @endif
                        @if (Helpers::settings('social_whatsapp'))
                            <p><a href="{{ Helpers::settings('social_whatsapp') }}" target="_blank">WhatsApp</a></p>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
