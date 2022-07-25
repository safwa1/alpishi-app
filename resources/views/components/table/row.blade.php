@php
    $classes = 'text-gray-500/80 even:bg-gray-100';
@endphp

<tr {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</tr>
