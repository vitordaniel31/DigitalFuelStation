<tr>
<td class="header">
<a href="{{route('home')}}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
Digital Fuel Station
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
