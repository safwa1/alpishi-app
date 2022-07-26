<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="description" content="مكتب خالد البيشي للخدمات التجارية نقدم لكم خبرتنا الطويلة لاكثر من ٣٥ عاما في مجال تجارة واستيراد السيارات والشاحنات والمعدات ، ونحرص على توفير طلباتكم من السيارات الكورية بالاسعار المناسبة ، والشراء مباشرةً من المزادات الكبيرة والمعتمدة في كوريا ، ونهتم باختيار افضل السيارات الخالية من الاعطال والحوادث ، والممشى الحقيقي للسيارات">
    <meta property="og:description" content="مكتب خالد البيشي للخدمات التجارية نقدم لكم خبرتنا الطويلة لاكثر من ٣٥ عاما في مجال تجارة واستيراد السيارات والشاحنات والمعدات ، ونحرص على توفير طلباتكم من السيارات الكورية بالاسعار المناسبة ، والشراء مباشرةً من المزادات الكبيرة والمعتمدة في كوريا ، ونهتم باختيار افضل السيارات الخالية من الاعطال والحوادث ، والممشى الحقيقي للسيارات">
    <meta name="og:site_name" content="البيشي للخدمات التجارية للوساطة في استيراد سيارات الديزل الكورية">
    <meta name="title" content="البيشي للخدمات التجارية للوساطة في استيراد سيارات الديزل الكورية">
    <meta property="og:title" content="البيشي للخدمات التجارية للوساطة في استيراد سيارات الديزل الكورية">
    @if(request()->routeIs('commercial'))
        <meta property="og:image" content="{{ asset(\App\Http\Livewire\Commercials\CommercialViewer::$carCaverImage) }}">
    @else
        <meta property="og:image" content="{{ asset('media/logo.png') }}">
        <meta property="og:image:width" content="460">
        <meta property="og:image:height" content="228">
    @endif
    <meta property="og:image:type" content="image/png">
    <meta name="keywords" content="سيارات ديزل, سيارات مستعملة ,سيارات كورية ">
    <meta name="author" content="خالد البيشي">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <title>البيشي للخدمات التجارية للوساطة في استيراد سيارات الديزل الكورية</title>

    <link rel = "icon" type = "image/png" href ="{{ asset('media/logo.png') }}">

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
