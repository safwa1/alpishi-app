@props(['active', 'isLast'])

@php
    $classes = ($active ?? false)
                ? "menu-item flex items-center w-full px-6 py-3  border-b border-gray-100/60 text-sm text-primary gap-6"
                : "menu-item flex items-center w-full px-6 py-3  border-b border-gray-100/60 text-sm text-neutral-400 gap-6";

    $last = ($isLast ?? false)
                ? 'border-b-0'
                : '';
@endphp

<a
    {{ $attributes->merge(['class' => "$classes $last"]) }}>
    {{ $icon }}
    {{ $title }}
</a>
