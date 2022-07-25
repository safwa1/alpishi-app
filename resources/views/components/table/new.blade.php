@props(['columnHeaders'])

@php
    $classes = 'w-full whitespace-no-wrap';
@endphp

<table {{ $attributes->merge(['class' => $classes]) }}>
    <thead>
    <x-table.header-row>
        @foreach($columnHeaders as $column)
            <x-table.header-cell>
                {{$column}}
            </x-table.header-cell>
        @endforeach
    </x-table.header-row>
    </thead>
    <x-table.tbody>
        {{ $content }}
    </x-table.tbody>
</table>
