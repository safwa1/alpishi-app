@props(['brand' , 'url', 'openInNewTab' => true])

@php
    $classes = "inline-block p-3 mb-2 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out";
@endphp

<a
    href="{{ $url }}"
    @if($openInNewTab)
        target="_blank"
    @endif>
    <button {{ $attributes->merge(['class' => $classes, 'type' => 'button', 'data-mdb-ripple' => 'true', 'data-mdb-ripple-color' => 'light', 'style' => "background-color:$brand"]) }}>
        {{ $slot }}
    </button>
</a>
