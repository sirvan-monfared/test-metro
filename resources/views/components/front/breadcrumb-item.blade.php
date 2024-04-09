<li {{ $attributes->merge(['class' => '']) }}>
    {{ $slot }}
</li>

@if(! isset($last) || ! $last)
    <li> > </li>
@endif
