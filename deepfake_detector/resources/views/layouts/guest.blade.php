<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RealOrNot') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
    $useMatrixBackground = request()->routeIs('login', 'register', 'password.*');
@endphp

<body class="glitch-page {{ $useMatrixBackground ? 'auth-matrix-page' : '' }}">

    @if ($useMatrixBackground)
        {{-- Matrix Rain hanya untuk Login, Register, dan password.* --}}
        <div class="matrix-container" aria-hidden="true">
            <div class="matrix-pattern" data-matrix-pattern></div>
        </div>
    @endif


<!-- Main Content -->
    <main class="glitch-form-wrapper">

        <div class="glitch-container relative z-10">

            

            {{ $slot }}

            <!-- Footer -->
           

        </div>

    </main>

</body>
</html>