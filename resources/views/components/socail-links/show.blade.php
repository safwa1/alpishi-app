@props(['links'])

@php
    $classes = 'relative w-full h-fit md:min-h-[16rem] overflow-hidden bg-gradient-to-r from-gray-100 to-gray-300';
@endphp

<section {{ $attributes->merge(['class' => $classes]) }}>

    <x-socail-links.container>

        <x-socail-links.title />

        <x-socail-links.layout>
            <!-- Phone -->
            <x-socail-links.link brand="#3eb991" url="tel:{{ no_space($links['phone']) ?? '#' }}">
                <x-icons.phone />
            </x-socail-links.link>

            <!-- Whatsapp -->
            <x-socail-links.link brand="#128c7e" :url="$links['whatsapp'] ?? '#'">
                <x-icons.whatsapp />
            </x-socail-links.link>

            <!-- Mail -->
            <x-socail-links.link brand="#ea4335" url="mailto:{{$links['email'] ?? '#'}}">
                <x-icons.email />
            </x-socail-links.link>

            <!-- Telegram -->
            <x-socail-links.link brand="#0088cc" :url="$links['telegram'] ?? '#'">
                <x-icons.telegram />
            </x-socail-links.link>

            <!-- Facebook -->
            <x-socail-links.link brand="#1877f2" :url="$links['facebook'] ?? '#'">
                <x-icons.facebook />
            </x-socail-links.link>

            <!-- Instagram -->
            <x-socail-links.link brand="#c13584" :url="$links['instagram'] ?? '#'">
                <x-icons.instagram />
            </x-socail-links.link>

            <!-- Twitter -->
            <x-socail-links.link brand="#1da1f2" :url="$links['twitter'] ?? '#'">
                <x-icons.twitter />
            </x-socail-links.link>

            <!-- Snapchat -->
            <x-socail-links.link brand="#f8cc1b" :url="$links['snapchat'] ?? '#'">
                <x-icons.snapchat />
            </x-socail-links.link>
        </x-socail-links.layout>

    </x-socail-links.container>
</section>
