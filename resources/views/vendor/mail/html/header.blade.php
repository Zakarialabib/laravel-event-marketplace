@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('images/' . settings('site_logo')) }}" class="logo"
                    alt="{{ settings('site_title') }}">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
