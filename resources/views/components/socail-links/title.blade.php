@props(['text' => 'تواصل معنا'])

@php
    $classes = '!font-bold md:text-2xl text-xl !font-noto text-center'
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $text }}
</div>
