<!DOCTYPE html>
<html class="lg:text-[100%] min-[532px]:text-[75%] text-[70%]" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @if(session('success'))
            <script>
                alert("{{session('success')}}")
            </script>
        @elseif(session('fail'))
            <script>
                alert("{{session('fail')}}")
            </script>
        @endif
    <div class="flex flex-col mt-4 min-h-screen">
        <x-header/>
        <main>
            {{ $slot }}
        </main>
    </div>
    </body>
    <x-footer/>
</html>
