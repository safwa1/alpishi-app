@props([
    'd' => '',
    'dFill'=> null,
    'strokeLinecap' => null,
    'strokeLinejoin' => null
])

<path
    @if($dFill)
        fill="{{$dFill}}"
    @endif
    @if($strokeLinecap)
        stroke-linecap="{{$strokeLinecap}}"
    @endif
    @if($strokeLinejoin)
        stroke-linejoin="{{$strokeLinejoin}}"
    @endif
    d="{{$d}}" />
