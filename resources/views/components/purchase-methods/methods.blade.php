@php
    $classes = 'w-full md:px-10 px-5 py-5 flex items-center justify-center space-y-4 flex-col';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
