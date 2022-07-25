@props(['message' => 'القائمة فارغة!'])

@php
    $classes = "w-full min-h-[30rem] overflow-hidden md:mb-2 mb-1 md:border-t-0 border-t flex items-center justify-center";
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <span class="w-full h-full text-center max-w-max font-bold text-xl text-error flex items-center flex-col gap-8">
        <x-icons.empty-list />
        {{ $message }}
    </span>
</div>
