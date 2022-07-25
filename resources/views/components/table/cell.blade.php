@php
    $classes = 'px-4 py-1 text-sm font-semibold';
@endphp

<td {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</td>
