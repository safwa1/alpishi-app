@php
    $classes = 'px-4 py-1';
@endphp

<td {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex items-center gap-2 text-sm">
     {{ $slot }}
    </div>
</td>
