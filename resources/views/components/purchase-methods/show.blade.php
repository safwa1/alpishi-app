@props(['collapsed' => false])

@php
    $classes = 'w-full h-fit md:min-h-[28rem] overflow-hidden bg-[#D7E5EB]/60';
@endphp

<section {{ $attributes->merge(['class' => $classes]) }}>
    <x-container>

        <!--title -->
        <x-purchase-methods.title />

        <!-- content -->
        <x-purchase-methods.methods>
            <x-purchase-methods.one :collapsed="$collapsed" />
            <x-purchase-methods.two :collapsed="$collapsed" />
            <x-purchase-methods.three :collapsed="$collapsed" />
        </x-purchase-methods.methods>

    </x-container>
</section>
