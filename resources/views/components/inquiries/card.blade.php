@php
    $classes = 'w-full px-4 py-6 space-y-6 max-w-xl bg-white opacity-75 backdrop-blur-md overflow-hidden rounded-2xl border border-blue-100 shadow-[rgba(7,_65,_210,_0.1)_0px_9px_30px]'
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>

    <div class="w-full">
        {{$icon}}
    </div>

    <!-- Title Slot -->
    {{ $title }}

    <!-- Indicator Slot -->
    {{ $indicator }}

    <!-- Body Slot -->
    {{ $body }}

    <!-- Whatsapp Button Slot -->
    <div class="flex justify-center">
        {{ $whatsappButton }}
    </div>

</div>
