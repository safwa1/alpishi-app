@php
    $classes = 'px-4 py-3';
@endphp

<div></div>
<th {{ $attributes->merge(['class' => $classes]) }}>
    {{$slot}}
</th>
