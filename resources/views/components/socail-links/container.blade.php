@php
    $classes = 'w-full md:min-h-[16rem] md:px-10 px-5 py-6 flex items-center justify-center flex-col space-y-6';
@endphp

<x-container>
    <div {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </div>
</x-container>
