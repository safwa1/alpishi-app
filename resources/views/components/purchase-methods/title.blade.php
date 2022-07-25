@props(['title' => 'آليات شراء السيارات من كوريا'])
@php
    $classes = 'px-4 !font-noto md:py-12 pt-6 pb-3 md:text-2xl text-xl md:font-bold font-semibold text-neutral-700 text-center';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $title }}
</div>
