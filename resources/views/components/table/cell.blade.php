@php
    $classes = 'px-4 py-1 text-sm font-semibold whitespace-wrap';
@endphp

<td {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</td>
