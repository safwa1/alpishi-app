@props(['url'])

@php
    $hasHttpProtocol = str($url)->startsWith("http");
    $classes = 'w-full h-full z-10 absolute inset-0 ';
    $classes .= $hasHttpProtocol ? 'filter blur-md' : 'img-blur';
@endphp

<style>
    .img-blur {
        background-image: url('{{$url}}');
        background-clip: content-box;
        background-position: center;
        background-size: cover;
        filter: blur(13px);
    }
</style>

@if($hasHttpProtocol)
    <img {{ $attributes->merge(['class' => $classes]) }} src="{{ $url }}" alt="" />
@else
    <div {{ $attributes->merge(['class' => $classes]) }}></div>
@endif
