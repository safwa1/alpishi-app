@php
    $classes = 'px-4 py-3 whitespace-nowrap';
@endphp

<div></div>
<th {{ $attributes->merge(['class' => $classes]) }}>
    {{$slot}}
</th>
