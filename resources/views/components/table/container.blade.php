@php
    $classes = 'overflow-hidden w-full m-auto bg-white py-2';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <div class="overflow-x-auto w-full sm:scrollbar-default scrollbar-hide scroll-smooth">
        {{ $slot }}
    </div>
</div>
