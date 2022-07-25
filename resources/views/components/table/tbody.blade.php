@php
    $classes = 'bg-white divide-y';
@endphp

<tbody {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</tbody>
