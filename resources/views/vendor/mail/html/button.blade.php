@props([
    'url',
    'color' => '#CF9411',
    'align' => 'center',
])

<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td>
                <a href="{{ $url }}" target="_blank" rel="noopener"
                    style="
                        background: #CF9411;
                        border-radius: 8px;
                        color: #fff;
                        display: inline-block;
                        padding: 13px 32px;
                        font-weight: 600;
                        font-family: 'Tajawal', sans-serif;
                        text-decoration: none;
                        text-align: center;
                        transition: all .3s ease-in-out;
                    "
                    onmouseover="this.style.backgroundColor='#1B7A75'"
                    onmouseout="this.style.backgroundColor='#CF9411'">
                    {{ $slot }}
                </a>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>
