<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DeepGuard AI - Deteksi Deepfake</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts (Tailwind via Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900 text-gray-100">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            
            <!-- Navbar Atas (Login / Register) -->
            <div class="absolute top-0 right-0 w-full p-6 flex justify-end z-10">
                @if (Route::has('login'))
                    <nav class="flex gap-4">
                        @auth
                            <a href="{{ url('/detect') }}" class="text-sm font-semibold text-gray-300 hover:text-white transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-300 hover:text-white transition">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-300 hover:text-white transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>

            <!-- Konten Utama (Hero Section) -->
            <main class="flex flex-col items-center justify-center px-6 text-center z-10 w-full max-w-3xl">
                <!-- Logo Aplikasi -->
                <img src="{{ asset('images/logo.png') }}" alt="RealOrNot AI Logo" class="h-24 w-auto mb-8 drop-shadow-lg">
                
                <!-- Judul Utama -->
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight">
                    RealOrNot <span class="text-blue-500">AI</span>
                </h1>
                
                <!-- Subjudul / Deskripsi -->
                <p class="text-lg md:text-xl text-gray-400 mb-10 leading-relaxed">
                    Sistem deteksi manipulasi citra wajah. Unggah gambar dan biarkan model klasifikasi EfficientNet-B2 kami menganalisis keasliannya.
                </p>
                
                <!-- Tombol Aksi -->
                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ url('/detect') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-200 flex items-center justify-center">
                            Buka Dashboard Deteksi
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-200 flex items-center justify-center">
                            Mulai Analisis
                        </a>
                        <a href="{{ route('register') }}" class="bg-gray-800 hover:bg-gray-700 border border-gray-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-200 flex items-center justify-center">
                            Buat Akun
                        </a>
                    @endauth
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="absolute bottom-6 w-full text-center text-sm text-gray-600">
                © {{ date('Y') }} RealOrNot. All rights reserved.
            </footer>

            <!-- Aksen Latar Belakang (Opsional: Membuat tampilan lebih modern) -->
            <div class="absolute inset-0 bg-[url('https://laravel.com/assets/img/welcome/background.svg')] bg-center opacity-10 pointer-events-none"></div>
        </div>
    </body>
</html>