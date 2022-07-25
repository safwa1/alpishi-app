<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alpishi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@500&family=Tajawal:wght@300;400;500&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- scripts -->
    <script src="{{ asset('bladewind/js/helpers.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireStyles
</head>
<body class="antialiased">

<livewire:static-messages-viewer />

<x-header.header />
@if(!request()->routeIs('commercials') && !request()->routeIs('auction') && !request()->routeIs('commercial'))
    <x-menu.nav-menu />
@endif

{{ $slot }}

<x-footer-section :links="$socials" />

@stack('home-scripts')
@livewireScripts
</body>
</html>
