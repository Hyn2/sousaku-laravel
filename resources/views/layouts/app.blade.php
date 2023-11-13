@php
    $user = auth()->user();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <div class="flex flex-col">
        <div class="flex mb-3 justify-center">
            <div class="relative basis-9/12 text-center">
                <a href="/"><div class="text-5xl font-extrabold">UMJUNSIK</div></a>
            </div>
            <div>
                <div class="absolute w-1/3 top-3">
                    @auth
                        <div class="absolute top-3">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="font-semibold text-black hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 font-semibold text-black hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-1">
            <div class="mx-5">
                <a href="{{route("form.create")}}">멤버 구하기</a>
            </div>
            <div class="mx-5">
                <a href="{{route('form.index')}}">공고 글</a>
            </div>
        </div>
        <main>
            <div class="flex justify-center mt-10">
                {{ $slot }}
            </div>
        </main>
    </div>
    </body>
</html>
