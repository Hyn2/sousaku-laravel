<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="basis-3/4 bg-red-500">
            <img class="w-full" src="https://getwallpapers.com/wallpaper/full/3/4/7/1430681-john-mayer-wallpaper-1920x1080-for-windows-7.jpg" />
        </div>
    </div>
</x-app-layout>
</html>
