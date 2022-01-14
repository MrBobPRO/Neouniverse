<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection ('title')
            @yield('title') – Neo Universe
        @else
            Neo Universe
        @endif
    </title>

    {{-- Noindex remove on production --}}
    <meta name="robots" content="none" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yandex" content="none">

    {{-- Roboto Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('js/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/owl-carousel/owl.theme.default.min.css') }}">
    {{-- Selectric --}}
    <link rel="stylesheet" href="{{ asset('js/selectric/selectric.css') }}">
    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/uncompressed/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uncompressed/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uncompressed/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uncompressed/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uncompressed/news.css') }}">
</head>

<body>
    @include('layouts.header')
    @yield('main')
    @include('layouts.footer')

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Owl Carousel --}}
    <script src="{{ asset('js/owl-carousel/owl.carousel.min.js') }}"></script>
    {{-- Selectric plugin --}}
    <script src="{{ asset('js/selectric/selectric.min.js') }}"></script>
    {{-- Google Maps --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAneCOkP0fjY3gOXV9DYFTdA59yWXDvNLw&language={{ $locale }}&callback=initMap" async defer></script>
    {{-- Scripts --}}
    <script src="{{ asset('js/uncompressed/main.js') }}"></script>
</body>

</html>