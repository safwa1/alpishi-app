@php
    $classes = 'w-full md:min-h-[36rem] md:px-10 px-5 py-6 flex items-center justify-center flex-col';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
