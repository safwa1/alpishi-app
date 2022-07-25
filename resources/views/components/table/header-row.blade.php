@php
    $classes = 'text-sm font-semibold tracking-wide text-right text-gray-600 border-b';
@endphp

<tr {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</tr>
