<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://kodesign.ir/laraplus-alone.png" class="logo" alt="Laraplus Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
