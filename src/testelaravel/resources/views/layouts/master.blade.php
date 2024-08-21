<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Teste Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
    </head>
    <body class="h-full">
    @include('layouts.navbar')
    @yield('content')
    <!-- footer -->
{{--    @include('layouts.footer')--}}
    @yield('scripts')
    </body>
</html>
