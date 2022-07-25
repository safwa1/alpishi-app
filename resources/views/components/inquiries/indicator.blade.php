@php
    $classes = 'bg-error w-20 h-2 rounded-full mx-auto';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}></div>
