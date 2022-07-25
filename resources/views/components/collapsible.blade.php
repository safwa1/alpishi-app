@props(['collapsed' => false])

@php
    $classes = 'relative w-full max-w-xl bg-white overflow-hidden rounded-lg cursor-pointer border border-blue-100 hover:shadow-[rgba(7,_65,_210,_0.1)_0px_9px_30px]'
@endphp

<div
    {{ $attributes->merge(['class' => $classes])}}
    x-data="{ open: {{Js::from($collapsed)}} }">

    {{-- Title Slot --}}
    <div
        class="w-full p-4 flex justify-between"
        :class="{ 'border-b border-neutral-200' : open }"
        @click="open = !open">

        {{-- Title --}}
        <span class="text-primary font-semibold">
            {{ $title }}
        </span>

        {{-- Icon --}}
        <div class="text-primary/70">
            <svg
                x-data="{ down:'M19 9l-7 7-7-7', up: 'M5 15l7-7 7 7' }"
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" :d="open ? up : down" />
            </svg>
        </div>
    </div>

    {{-- Body Slot --}}
    <div x-show="open" class="px-5 py-4 text-neutral-400">
        {{ $body }}
    </div>
</div>
