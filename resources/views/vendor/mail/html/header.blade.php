<tr>
<td class="header">
<a href="{{route('home')}}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('DigitalFuelStation/logo.png')}}" class="logo" alt="Digital Fuel Station Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
