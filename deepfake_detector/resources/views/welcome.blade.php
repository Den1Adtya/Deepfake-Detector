<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RealOrNot AI — Intelligent Deepfake Detection</title>

    <meta name="description"
        content="RealOrNot AI adalah platform deteksi deepfake berbasis EfficientNet-B2 dengan visualisasi Explainable AI menggunakan Grad-CAM.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
/* NEON GREEN CYBER GRID */
        .grid-bg {
            width: 100%;
            height: 100%;
            background-color: #050505;

            background-image:
                /* Vignette */
                radial-gradient(
                    circle at center,
                    transparent 30%,
                    #000 90%
                ),

                /* Main Grid - Neon Green */
                linear-gradient(
                    rgba(57, 255, 20, 0.12) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(57, 255, 20, 0.12) 1px,
                    transparent 1px
                ),

                /* Secondary Grid - Toxic Green */
                linear-gradient(
                    rgba(124, 255, 107, 0.055) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(124, 255, 107, 0.055) 1px,
                    transparent 1px
                );

            background-size:
                100% 100%,
                60px 60px,
                60px 60px,
                20px 20px,
                20px 20px;

            /* Mask */
            mask-image: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.8),
                transparent 92%
            );
        }

        .gradient-text {
            background: linear-gradient(100deg, #39FF14 0%, #B9FFB0 72%, #FF2D55 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* A restrained chromatic split: used on one hero headline only. */
        .glitch-accent {
            text-shadow: -1px 0 rgba(255, 45, 85, 0.42), 1px 0 rgba(57, 255, 20, 0.32);
        }

        .glitch-accent:hover {
            animation: micro-glitch 260ms steps(2, end) 1;
        }

        @keyframes micro-glitch {
            0% { transform: translateX(0); }
            35% { transform: translateX(1px); }
            70% { transform: translateX(-1px); }
            100% { transform: translateX(0); }
        }

        .glass {
            background: rgba(12, 20, 15, 0.72);
            border: 1px solid rgba(57, 255, 20, 0.14);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 18px 60px rgba(0, 0, 0, 0.24);
        }

        .feature-card { transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease; }
        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(57, 255, 20, 0.35);
            background: rgba(18, 30, 21, 0.76);
        }

        .nav-link { transition: color 0.2s ease; }
        .nav-link:hover { color: #39FF14; }

        .hero-orb {
            background: radial-gradient(circle, rgba(57, 255, 20, 0.14), rgba(5, 6, 7, 0) 70%);
        }
        .hero-orb--red {
            background: radial-gradient(circle, rgba(255, 45, 85, 0.105), rgba(5, 6, 7, 0) 70%);
        }

        .scan-line { animation: scan 3.4s ease-in-out infinite; }
        @keyframes scan {
            0%, 100% { top: 15%; opacity: 0.22; }
            50% { top: 80%; opacity: 0.82; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body class="site-landing antialiased">


    <!-- NAVBAR -->
    @include('layouts.navigation')


    <!-- HERO SECTION -->
    <main>

        <section class="relative min-h-[calc(100vh-112px)] flex items-center overflow-hidden">  

            <!-- BACKGROUND -->
            <div class="absolute inset-0 pointer-events-none"></div>

            <div class="absolute w-[600px] h-[600px] hero-orb top-[-150px] left-[-150px] pointer-events-none"></div>

            <div class="absolute w-[600px] h-[600px] hero-orb hero-orb--red bottom-[-200px] right-[-150px] pointer-events-none"></div>


            <div class="relative w-full max-w-7xl mx-auto
    px-6 lg:px-10
    grid grid-cols-1 lg:grid-cols-2
    gap-8 lg:gap-10
    items-center
    pt-8 pb-10 lg:pt-4 lg:pb-6">

                <!-- HERO TEXT -->
                <div class="relative z-10 lg:-translate-y-5">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] mb-7">
                        See Beyond
                        <br>
                        <span class="gradient-text glitch-accent glitch-text" data-text="What Looks Real.">What Looks Real.</span>
                    </h1>


                    <p class="text-[#89968D] text-lg leading-relaxed max-w-xl mb-9">

                        Discover the truth behind every image. RealOrNot AI
                        analyzes facial images using deep learning to identify
                        potential deepfake manipulation with explainable AI visualization.

                    </p>


                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">

                        @auth

                            <a href="{{ url('/detect') }}"
                                class="neon-button inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl bg-[#39FF14] hover:bg-[#7CFF6B] text-[#071008] font-bold transition shadow-xl shadow-[#39FF14]/10">

                                Open Detection Dashboard

                                <span>→</span>

                            </a>

                        @else

                            <a href="{{ route('login') }}"
                                class="neon-button inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl bg-[#39FF14] hover:bg-[#7CFF6B] text-[#071008] font-bold transition shadow-xl shadow-[#39FF14]/10">

                                Start Analyzing

                                <span>→</span>

                            </a>

                            @if (Route::has('register'))

                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center px-7 py-4 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-white font-semibold transition">

                                    Create Account

                                </a>

                            @endif

                        @endauth

                    </div>


                    <!-- TRUST INDICATORS -->
                    <div class="flex flex-wrap items-center gap-8 text-sm text-[#718077]">

                        <div class="flex items-center gap-2">

                            <span class="text-[#39FF14]">✦</span>

                            Deep Learning

                        </div>

                        <div class="flex items-center gap-2">

                            <span class="text-[#39FF14]">✦</span>

                            Explainable AI

                        </div>

                        <div class="flex items-center gap-2">

                            <span class="text-[#39FF14]">✦</span>

                            Image Analysis

                        </div>

                    </div>

                </div>

                      <!-- FACE SCANNER -->
                    <div class="relative w-full min-w-0 flex justify-center lg:translate-x-0">
                        @include('components.face-scanner')
                    </div>
            </div>

        </section>


        <!-- TECHNOLOGY STRIP -->
        <section class="border-y border-white/5 bg-white/[0.015]">

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">

                <p class="text-center text-xs tracking-[0.25em] uppercase text-[#718077] mb-6">
                    Powered by intelligent technology
                </p>

                <div class="flex flex-wrap justify-center items-center gap-10 md:gap-20">

                    <span class="text-lg font-bold text-[#89968D]">Deep Learning</span>

                    <span class="text-lg font-bold text-[#89968D]">EfficientNet-B2</span>

                    <span class="text-lg font-bold text-[#89968D]">Grad-CAM</span>

                    <span class="text-lg font-bold text-[#89968D]">Explainable AI</span>

                </div>

            </div>

        </section>


        <!-- FEATURES -->
        <section id="features" class="py-28 relative">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="max-w-2xl mx-auto text-center mb-16">

                    <span class="text-sm font-bold tracking-widest text-[#39FF14] uppercase">
                        Core Capabilities
                    </span>

                    <h2 class="text-4xl md:text-5xl font-extrabold mt-5 mb-6">
                        Intelligence Behind
                        <span class="gradient-text">Every Analysis.</span>
                    </h2>

                    <p class="text-[#89968D] leading-relaxed">
                        A combination of deep learning and explainable AI
                        designed to help users understand image authenticity.
                    </p>

                </div>


                <div class="grid md:grid-cols-3 gap-6">

                    {{-- FEATURE 1 --}}
                    <div class="feature-card terminal-feature-card">

                        <div class="terminal-feature-header">
                            <span>01_detection.sh</span>
                            <span class="terminal-status">MODULE_01</span>
                        </div>

                        <div class="terminal-feature-body">

                            <h3 class="terminal-feature-title glitch-text"
                                data-text="Deepfake Detection">
                                Deepfake Detection
                            </h3>

                            <p class="terminal-feature-description">
                                Analyze facial images using the EfficientNet-B2
                                deep learning architecture to classify potential
                                real and manipulated images.
                            </p>

                            <div class="terminal-feature-footer">
                                <span>ENGINE: EFFICIENTNET-B2</span>
                                <span>● ACTIVE</span>
                            </div>

                        </div>

                    </div>


                    {{-- FEATURE 2 --}}
                    <div class="feature-card terminal-feature-card">

                        <div class="terminal-feature-header">
                            <span>02_gradcam.sh</span>
                            <span class="terminal-status">MODULE_02</span>
                        </div>

                        <div class="terminal-feature-body">

                            <h3 class="terminal-feature-title glitch-text"
                                data-text="Visual Explanation">
                                Visual Explanation
                            </h3>

                            <p class="terminal-feature-description">
                                Understand the model's attention through
                                Grad-CAM visualization, highlighting image
                                regions that influence predictions.
                            </p>

                            <div class="terminal-feature-footer">
                                <span>ENGINE: GRAD-CAM</span>
                                <span>● ACTIVE</span>
                            </div>

                        </div>

                    </div>


                    {{-- FEATURE 3 --}}
                    <div class="feature-card terminal-feature-card">

                        <div class="terminal-feature-header">
                            <span>03_history.sh</span>
                            <span class="terminal-status">MODULE_03</span>
                        </div>

                        <div class="terminal-feature-body">

                            <h3 class="terminal-feature-title glitch-text"
                                data-text="Analysis History">
                                Analysis History
                            </h3>

                            <p class="terminal-feature-description">
                                Keep track of previous image analysis results
                                and revisit your detection activities
                                through an organized interface.
                            </p>

                            <div class="terminal-feature-footer">
                                <span>ENGINE: DATA STORAGE</span>
                                <span>● ACTIVE</span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- HOW IT WORKS -->
        <section id="how-it-works" class="py-28 bg-transparent border-y border-white/5">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center max-w-2xl mx-auto mb-16">

                    <span class="text-sm font-bold tracking-widest text-[#39FF14] uppercase">
                        Simple Workflow
                    </span>

                    <h2 class="text-4xl md:text-5xl font-extrabold mt-5 mb-6">
                        How It Works
                    </h2>

                    <p class="text-[#89968D]">
                        Three simple steps to explore the authenticity
                        of a facial image.
                    </p>

                </div>


                <div class="grid md:grid-cols-3 gap-6">

                    {{-- STEP 01 --}}
                    <div class="terminal-feature-card">

                        <div class="terminal-feature-header">
                            <span>01_upload.sh</span>
                            <span class="terminal-status">STEP_01</span>
                        </div>

                        <div class="terminal-feature-body">

                            <h3 class="terminal-feature-title glitch-text"
                                data-text="Upload Image">
                                Upload Image
                            </h3>

                            <p class="terminal-feature-description">
                                Select and upload a facial image
                                that you want to analyze.
                            </p>

                            <div class="terminal-feature-footer">
                                <span>INPUT: IMAGE FILE</span>
                                <span>● READY</span>
                            </div>

                        </div>

                    </div>


                    {{-- STEP 02 --}}
                    <div class="terminal-feature-card">

                        <div class="terminal-feature-header">
                            <span>02_processing.sh</span>
                            <span class="terminal-status">STEP_02</span>
                        </div>

                        <div class="terminal-feature-body">

                            <h3 class="terminal-feature-title glitch-text"
                                data-text="AI Processing">
                                AI Processing
                            </h3>

                            <p class="terminal-feature-description">
                                The EfficientNet-B2 model processes
                                the image and generates a prediction.
                            </p>

                            <div class="terminal-feature-footer">
                                <span>ENGINE: EFFICIENTNET-B2</span>
                                <span>● ACTIVE</span>
                            </div>

                        </div>

                    </div>


                    {{-- STEP 03 --}}
                    <div class="terminal-feature-card">

                        <div class="terminal-feature-header">
                            <span>03_results.sh</span>
                            <span class="terminal-status">STEP_03</span>
                        </div>

                        <div class="terminal-feature-body">

                            <h3 class="terminal-feature-title glitch-text"
                                data-text="Explore Results">
                                Explore Results
                            </h3>

                            <p class="terminal-feature-description">
                                Review the classification result
                                and Grad-CAM visualization.
                            </p>

                            <div class="terminal-feature-footer">
                                <span>OUTPUT: ANALYSIS</span>
                                <span>● READY</span>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </section>


        <!-- TECHNOLOGY -->
<section id="technology" class="py-28 relative">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-10 lg:gap-14 items-center">

        {{-- ================= LEFT: TECHNOLOGY INFORMATION ================= --}}

        <div>

            <span class="inline-flex items-center gap-2 text-xs font-bold tracking-widest text-[#39FF14] uppercase mb-5">

                <span class="w-2 h-2 rounded-full bg-[#39FF14]"></span>

                SYSTEM_TECHNOLOGY // OVERVIEW

            </span>


            <h2 class="text-4xl md:text-5xl font-extrabold mt-2 mb-7 leading-tight">

                Not Just Detection.

                <span class="gradient-text">
                    Understanding AI.
                </span>

            </h2>


            <p class="text-[#89968D] leading-relaxed mb-9">

                RealOrNot AI combines EfficientNet-B2 with
                Grad-CAM to provide image classification
                alongside a visual explanation of the model's
                attention.

            </p>


            {{-- TECHNOLOGY MODULES --}}

            <div class="space-y-5">


                {{-- MODULE 01 --}}

                <div class="terminal-tech-item">

                    <div class="terminal-tech-header">

                        <span>01_efficientnet.sh</span>

                        <span>MODULE_01</span>

                    </div>


                    <div class="terminal-tech-body">

                        <div class="terminal-tech-number">
                            01
                        </div>

                        <div>

                            <h3 class="terminal-tech-title glitch-text"
                                data-text="EfficientNet-B2">

                                EfficientNet-B2

                            </h3>

                            <p class="terminal-tech-description">

                                A convolutional neural network architecture
                                used for image feature extraction and classification.

                            </p>

                            <div class="terminal-tech-meta">
                                TYPE: CNN ARCHITECTURE
                            </div>

                        </div>

                    </div>

                </div>


                {{-- MODULE 02 --}}

                <div class="terminal-tech-item">

                    <div class="terminal-tech-header">

                        <span>02_gradcam.sh</span>

                        <span>MODULE_02</span>

                    </div>


                    <div class="terminal-tech-body">

                        <div class="terminal-tech-number">
                            02
                        </div>

                        <div>

                            <h3 class="terminal-tech-title glitch-text"
                                data-text="Grad-CAM">

                                Grad-CAM

                            </h3>

                            <p class="terminal-tech-description">

                                A visualization technique that highlights
                                image regions contributing to the model's prediction.

                            </p>

                            <div class="terminal-tech-meta">
                                TYPE: EXPLAINABLE AI
                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>


        {{-- ================= RIGHT: AI ARCHITECTURE ================= --}}

        <div class="terminal-feature-card technology-architecture">

            {{-- TERMINAL HEADER --}}

            <div class="terminal-feature-header">

                <span>03_ai_architecture.sh</span>

                <span class="terminal-status">
                    SYSTEM_MAP
                </span>

            </div>


            {{-- TERMINAL BODY --}}

            <div class="technology-architecture-body">

                {{-- TITLE --}}

                <div class="flex justify-between items-center mb-7">

                    <div>

                        <p class="text-[10px] font-mono tracking-widest text-[#39FF14] mb-2">
                            REALORNOT AI
                        </p>

                        <h3 class="text-lg font-bold text-[#F5FFF7]">
                            AI Processing Pipeline
                        </h3>

                    </div>

                    <span class="text-[9px] font-mono text-[#7CFF6B]">
                        V1.0
                    </span>

                </div>


                {{-- INPUT NODE --}}

                <div class="terminal-architecture-node">

                    <span class="terminal-node-label">
                        INPUT_SOURCE
                    </span>

                    <h4>
                        Facial Image
                    </h4>

                </div>


                {{-- CONNECTOR --}}

                <div class="terminal-architecture-connector">
                    <span>↓</span>
                </div>


                {{-- FEATURE EXTRACTION --}}

                <div class="terminal-architecture-node">

                    <span class="terminal-node-label">
                        FEATURE_EXTRACTION
                    </span>

                    <h4>
                        EfficientNet-B2
                    </h4>

                </div>


                {{-- CONNECTOR --}}

                <div class="terminal-architecture-connector">
                    <span>↓</span>
                </div>


                {{-- PARALLEL PROCESSING --}}

                <div class="grid grid-cols-2 gap-4">

                    {{-- CLASSIFICATION --}}

                    <div class="terminal-architecture-node">

                        <span class="terminal-node-label">
                            CLASSIFICATION
                        </span>

                        <h4 class="text-sm">
                            Prediction
                        </h4>

                    </div>


                    {{-- EXPLAINABILITY --}}

                    <div class="terminal-architecture-node">

                        <span class="terminal-node-label">
                            EXPLAINABILITY
                        </span>

                        <h4 class="text-sm">
                            Grad-CAM
                        </h4>

                    </div>

                </div>


                {{-- CONNECTOR --}}

                <div class="terminal-architecture-connector">
                    <span>↓</span>
                </div>


                {{-- OUTPUT --}}

                <div class="terminal-architecture-output">

                    <span class="terminal-node-label">
                        FINAL_OUTPUT
                    </span>

                    <h4>
                        Analysis & Visualization
                    </h4>

                    <div class="flex justify-center gap-5 mt-4">

                        <span class="text-[9px] font-mono text-[#39FF14]">
                            ● REAL
                        </span>

                        <span class="text-[9px] font-mono text-[#FF2D55]">
                            ● FAKE
                        </span>

                    </div>

                </div>


                {{-- TERMINAL FOOTER --}}

                <div class="technology-architecture-footer">

                    <span>PROCESS: COMPLETE</span>

                    <span>● SYSTEM READY</span>

                </div>

            </div>

        </div>

    </div>

</section>


        <!-- ABOUT / CTA -->
<section id="about" class="py-24 relative">

    <div class="max-w-5xl mx-auto px-6 lg:px-8">

        <div class="terminal-feature-card terminal-cta">

            {{-- TERMINAL HEADER --}}
            <div class="terminal-feature-header">

                <span>04_authenticity.sh</span>

                <span class="terminal-status">
                    ACCESS_PORTAL
                </span>

            </div>


            {{-- TERMINAL BODY --}}
            <div class="terminal-cta-body">

                {{-- STATUS LABEL --}}
                <div class="terminal-cta-label">

                    <span class="terminal-cta-dot"></span>

                    EXPLORE IMAGE AUTHENTICITY

                </div>


                {{-- HEADING --}}
                <h2 class="terminal-cta-title glitch-text"
                    data-text="Ready to See the Truth?">

                    Ready to See the Truth?

                </h2>


                {{-- DESCRIPTION --}}
                <p class="terminal-cta-description">

                    Start exploring image authenticity with
                    AI-powered detection and explainable visualization.

                </p>


                {{-- CTA BUTTON --}}
                <div class="mt-9 flex justify-center w-full">

                    @auth

                        <a href="{{ url('/detect') }}"
                            class="neon-button inline-flex items-center justify-center gap-3 px-8 py-4 rounded-lg font-bold">

                            Go to Dashboard

                            <span class="text-lg">→</span>

                        </a>

                    @else

                        <a href="{{ route('login') }}"
                            class="neon-button inline-flex items-center justify-center gap-3 px-8 py-4 rounded-lg font-bold">

                            Start Analyzing

                            <span class="text-lg">→</span>

                        </a>

                    @endauth

                </div>


                {{-- TERMINAL FOOTER --}}
                <div class="terminal-cta-footer">

                    <span>STATUS: READY</span>

                    <span>REALORNOT AI // 2026</span>

                </div>

            </div>

        </div>

    </div>

</section>

    </main>


    <!-- FOOTER -->
    <footer class="border-t border-white/5 bg-transparent">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">

            <div class="flex flex-col md:flex-row justify-between gap-10">

                <div class="max-w-sm">

                    <div class="flex items-center gap-3 mb-4">

                        <img src="{{ asset('images/logo.png') }}"
                            alt="RealOrNot AI"
                            class="w-9 h-9 object-contain">

                        <span class="text-lg font-extrabold">
                            RealOrNot<span class="text-[#39FF14]"> AI</span>
                        </span>

                    </div>

                    <p class="text-sm text-[#718077] leading-relaxed">
                        An AI-powered platform for exploring facial image
                        authenticity through deep learning and explainable AI.
                    </p>

                </div>


                <div class="flex gap-16">

                    <div>

                        <h4 class="font-bold text-sm mb-5">
                            Navigation
                        </h4>

                        <div class="space-y-3 text-sm text-[#718077]">

                            <a href="#features" class="block hover:text-white transition">
                                Features
                            </a>

                            <a href="#technology" class="block hover:text-white transition">
                                Technology
                            </a>

                            <a href="#how-it-works" class="block hover:text-white transition">
                                How It Works
                            </a>

                        </div>

                    </div>


                    <div>

                        <h4 class="font-bold text-sm mb-5">
                            Account
                        </h4>

                        <div class="space-y-3 text-sm text-[#718077]">

                            @auth

                                <a href="{{ url('/detect') }}"
                                    class="block hover:text-white transition">
                                    Dashboard
                                </a>

                            @else

                                <a href="{{ route('login') }}"
                                    class="block hover:text-white transition">
                                    Login
                                </a>

                                @if (Route::has('register'))

                                    <a href="{{ route('register') }}"
                                        class="block hover:text-white transition">
                                        Register
                                    </a>

                                @endif

                            @endauth

                        </div>

                    </div>

                </div>

            </div>


            <div class="border-t border-white/5 mt-12 pt-7 flex flex-col sm:flex-row justify-between gap-4 text-xs text-[#66736A]">

                <p>
                    © {{ date('Y') }} RealOrNot AI. All rights reserved.
                </p>

                <p>
                    Built with Deep Learning & Explainable AI.
                </p>

            </div>

        </div>

    </footer>

</body>
</html>