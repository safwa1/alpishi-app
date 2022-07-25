@props(['name'])

@switch($name)

    @case('phone')
        <x-icons.phone />
        @break

    @case('email')
        <x-icons.email />
        @break

    @case('whatsapp')
        <x-icons.whatsapp />
        @break

    @case('telegram')
        <x-icons.telegram />
        @break

    @case('instagram')
        <x-icons.instagram />
        @break

    @case('snapchat')
        <x-icons.snapchat />
        @break

    @case('facebook')
        <x-icons.facebook />
        @break

    @case('twitter')
        <x-icons.twitter />
        @break

    @default
        <x-icons.unknown />
@endswitch
