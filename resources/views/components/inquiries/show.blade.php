@props(['phoneNumber'])

@php
    $classes = 'w-full h-fit md:min-h-[36rem] overflow-hidden bg-gradient-to-r from-primary/50 via-purple-500 to-[#AFD7E6]/60';
@endphp

<!-- section -->
<section {{ $attributes->merge(['class' => $classes])}}>
    <x-container>
        <x-inquiries.container>
            <x-inquiries.card>

                <x-slot name="icon">
                    <x-inquiries.icon />
                </x-slot>

                <x-slot name="title">
                    <x-inquiries.title />
                </x-slot>

                <x-slot name="indicator">
                    <x-inquiries.indicator />
                </x-slot>

                <x-slot name="body">
                    <x-inquiries.body />
                </x-slot>

                <x-slot name="whatsappButton">
                    <x-inquiries.whatsapp-button :number="$phoneNumber"/>
                </x-slot>

            </x-inquiries.card>
        </x-inquiries.container>
    </x-container>
</section>
