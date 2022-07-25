@php
    $classes = 'md:flex md:justify-center md:items-center md:flex-wrap gap-2 grid grid-cols-4 place-items-center';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
