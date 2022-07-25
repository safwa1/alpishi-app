@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'text-sm font-bold text-[#d8e5ed] cursor-pointer h-full flex items-center opacity-100 hover:opacity-100'
                : 'text-sm font-bold text-[#d8e5ed] cursor-pointer h-full flex items-center opacity-70 hover:opacity-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
