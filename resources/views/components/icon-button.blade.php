@props(['title'])
@php
    $classes = 'flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-red-400 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-red-100 hover:rounded-full';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}></div>
<button
    title="{{$title}}">
    {{ $slot }}
</button>
