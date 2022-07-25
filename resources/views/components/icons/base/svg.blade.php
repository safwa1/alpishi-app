@props([
    'd' => '',
    'viewBox' => '0 0 24 24',
    'stroke' => null,
    'fill'=> null,
    'strokeWidth' => null,
    'dFill'=> null,
    'strokeLinecap' => null,
    'strokeLinejoin' => null
])

@php
    $classes = 'w-5 h-5';
@endphp

<svg
    {{ $attributes->merge(['xmlns' => 'http://www.w3.org/2000/svg', 'class' => $classes]) }}
    @if($fill)
        fill="{{$fill}}"
    @endif
    @if($stroke)
        stroke="{{$stroke}}"
    @endif
    @if($strokeWidth)
        stroke-width="{{$strokeWidth}}"
    @endif
    viewBox="{{$viewBox}}">
    <x-icons.base.path
        stroke-linecap="{{$strokeLinecap}}"
        stroke-linejoin="{{$strokeLinejoin}}"
        d-fill="{{$dFill}}"
        d="{{$d}}" />
</svg>
