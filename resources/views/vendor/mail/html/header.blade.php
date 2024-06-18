<tr>
    <td class="header">
        <a href="{{ $url }}">
            @php
                $logo = !empty(\Utilities::getSetting('gym_logo')) 
                    ? Storage::url(\Utilities::getSetting('gym_logo')) 
                    : 'images/gadmin-logo.png'
            @endphp
            <img src="{{ asset($logo) }}" alt="" height="55">
        </a>
    </td>
</tr>
