<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> {{$title ?? env('APP_NAME') }} </title>

        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script> --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body data-bs-theme="dark">
        
        @auth
            @persist('navbar')
                <x-navbar/>
            @endpersist
        @endauth

        {{$slot}}
    </body>

    <x-toast-message/>
</html>
