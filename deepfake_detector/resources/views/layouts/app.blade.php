<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
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
    <body class="app-shell font-sans antialiased text-[#F5FFF7]">
        

        <div class="min-h-screen app-shell__background">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="app-page-heading" data-reveal>
                    <div class="max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-8 app-page-heading__inner">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="app-main relative">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
