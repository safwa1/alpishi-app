@props(['type'])

@php
    $colors = ['info' => 'blue-500', 'error' => 'red-500', 'warning' => 'yellow-500', 'success' => 'green-500'];
    $classes = "inline-flex rounded-full h-3 w-3 bg-{$colors["{$type}"]} ml-2 shadow-lg shadow-{$colors["{$type}"]}";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}></span>
