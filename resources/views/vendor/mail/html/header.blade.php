@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://i.ibb.co/t1KNjJx/font-1.png" class="logo" alt="تنفيذ تك">
            @else
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>