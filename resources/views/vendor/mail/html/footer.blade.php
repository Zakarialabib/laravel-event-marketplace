<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="footer">
                    <p>&copy; {{ date('Y') }} {{ settings('company_name') }}.
                        {{ __('All rights reserved') }}.</p>
                    <p>{{ __('Contact') }}: {{ settings('company_email_address') }} | {{ __('Phone') }}:
                        {{ settings('company_phone') }}</p>
                    <p>{{ __('Address') }}: {{ settings('company_address') }}</p>


                    <p>
                        Stay connected with us:
                    </p>
                    <div style="display:flex; justify-content: center;flex-wrap: wrap; gap: 1rem">

                        @if (settings('social_facebook'))
                            <p><a href="{{ settings('social_facebook') }}" target="_blank">Facebook</a></p>
                        @endif
                        @if (settings('social_twitter'))
                            <p><a href="{{ settings('social_twitter') }}" target="_blank">Twitter</a></p>
                        @endif
                        @if (settings('social_instagram'))
                            <p><a href="{{ settings('social_instagram') }}" target="_blank">Instagram</a>
                            </p>
                        @endif
                        @if (settings('social_linkedin'))
                            <p><a href="{{ settings('social_linkedin') }}" target="_blank">LinkedIn</a></p>
                        @endif
                        @if (settings('social_whatsapp'))
                            <p><a href="{{ settings('social_whatsapp') }}" target="_blank">WhatsApp</a></p>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
