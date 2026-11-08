<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 — Page Not Found | RealOrNot AI</title>

    <meta name="description"
        content="The requested page could not be found on RealOrNot AI.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ==========================================
           REALORNOT AI - 404 ERROR PAGE
        ========================================== */

        .error-page {
            min-height: 100vh;
            background: #030503;
            color: #F5FFF7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            overflow: hidden;
            position: relative;
        }

        /* ERROR CONTAINER */

        .error-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 650px;
        }

        /* TERMINAL WINDOW */

        .error-terminal {
            background: rgba(3, 8, 4, 0.94);
            border: 1px solid rgba(57, 255, 20, 0.55);
            
            box-shadow:
                0 0 25px rgba(57, 255, 20, 0.08),
                inset 0 0 30px rgba(57, 255, 20, 0.025);

            overflow: hidden;
        }

        /* TERMINAL HEADER */

        .error-terminal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 13px 18px;

            background: #168F30;
            color: #020602;

            font-family: monospace;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
        }

        .error-terminal-dots {
            display: flex;
            gap: 6px;
        }

        .error-terminal-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.45);
        }

        .error-terminal-dots span:first-child {
            background: #FF2D55;
        }

        /* TERMINAL BODY */

        .error-terminal-body {
            position: relative;
            padding: 5px 35px 35px;
            text-align: center;
        }

        /* SYSTEM LABEL */

        .error-system-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            color: #7CFF6B;

            font-family: monospace;
            font-size: 11px;
            font-weight: 700;

            letter-spacing: 0.16em;
        }

        .error-system-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;

            background: #FF2D55;

            box-shadow: 0 0 10px #FF2D55;
        }

        /* 404 NUMBER */

        .error-code {
            margin: 22px 0;

            color: #39FF14;

            font-family: monospace;
            font-size: clamp(100px, 22vw, 175px);
            font-weight: 900;

            line-height: 1;
            letter-spacing: -0.08em;

            text-shadow:
                0 0 10px rgba(57, 255, 20, 0.55),
                0 0 30px rgba(57, 255, 20, 0.20),
                -4px 0 rgba(255, 45, 85, 0.35);
        }

       /* ==========================================
   RGB GLITCH EFFECT
========================================== */

.error-glitch {
    position: relative;

    display: inline-block;

    color: #39FF14;

    text-shadow:
        0 0 8px rgba(57, 255, 20, 0.7),
        0 0 25px rgba(57, 255, 20, 0.3);
}

.error-glitch::before {
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    color: var(--glitch-red-bright);
    pointer-events: none;
    animation: glitch-red 2.5s infinite linear alternate-reverse;
}
.error-glitch::after {
    content: attr(data-text);

    position: absolute;

    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    pointer-events: none;
}

.form-glitch-red {
    color: var(--glitch-red-bright);
    text-shadow:
        0 0 4px rgba(255, 25, 25, 0.65),
        0 0 10px rgba(255, 25, 25, 0.3);
}

.error-glitch::after {
    color: #39FF14;

    animation: glitch-green 2s infinite linear alternate-reverse;

    clip-path: inset(0 0 0 0);
}

/* RED GLITCH */

@keyframes glitch-red {

    0%, 85%, 100% {
        transform: translate(0);
        clip-path: inset(0 0 100% 0);
    }

    86% {
        transform: translate(-5px, 2px);
        clip-path: inset(20% 0 60% 0);
    }

    88% {
        transform: translate(5px, -2px);
        clip-path: inset(50% 0 30% 0);
    }

    90% {
        transform: translate(-3px, 1px);
        clip-path: inset(70% 0 10% 0);
    }

    92% {
        transform: translate(3px, 0);
        clip-path: inset(10% 0 75% 0);
    }

}

/* GREEN GLITCH */

@keyframes glitch-green {

    0%, 82%, 100% {
        transform: translate(0);
        clip-path: inset(100% 0 0 0);
    }

    84% {
        transform: translate(4px, -2px);
        clip-path: inset(60% 0 20% 0);
    }

    86% {
        transform: translate(-4px, 2px);
        clip-path: inset(15% 0 65% 0);
    }

    89% {
        transform: translate(3px, 0);
        clip-path: inset(40% 0 40% 0);
    }

    91% {
        transform: translate(-2px, -1px);
        clip-path: inset(75% 0 5% 0);
    }

}
        /* ERROR MESSAGE */

        .error-title {
            color: #39FF14;

            font-family: monospace;
            font-size: 22px;
            font-weight: 800;

            letter-spacing: 0.1em;
            text-transform: uppercase;

            margin-bottom: 14px;
        }

        .error-description {
            max-width: 430px;
            margin: 0 auto;

            color: #9EF5AD;

            font-family: monospace;
            font-size: 13px;
            line-height: 1.9;
        }

        /* ERROR INFORMATION */

        .error-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 18px;

            margin-top: 25px;

            color: rgba(124, 255, 107, 0.55);

            font-family: monospace;
            font-size: 10px;
            letter-spacing: 0.08em;
        }

        /* ACTION BUTTONS */

        .error-actions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;

            margin-top: 35px;
        }

        .error-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            min-width: 175px;
            padding: 13px 20px;

            font-family: monospace;
            font-size: 11px;
            font-weight: 800;

            letter-spacing: 0.08em;
            text-decoration: none;

            border: 1px solid #39FF14;

            transition:
                background 250ms ease,
                color 250ms ease,
                box-shadow 250ms ease,
                transform 250ms ease;

            cursor: pointer;
        }

        /* PRIMARY BUTTON */

        .error-button-primary {
            background: #39FF14;
            color: #030503;
        }

        .error-button-primary:hover {
            background: #7CFF6B;

            box-shadow:
                0 0 15px rgba(57, 255, 20, 0.35),
                0 0 30px rgba(57, 255, 20, 0.15);

            transform: translateY(-3px);
        }

        /* SECONDARY BUTTON */

        .error-button-secondary {
            background: transparent;
            color: #39FF14;
        }

        .error-button-secondary:hover {
            background: rgba(57, 255, 20, 0.10);

            box-shadow:
                0 0 15px rgba(57, 255, 20, 0.12);

            transform: translateY(-3px);
        }

        /* TERMINAL FOOTER */

        .error-terminal-footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;

            padding: 14px 20px;

            border-top: 1px solid rgba(57, 255, 20, 0.18);

            color: rgba(124, 255, 107, 0.5);

            font-family: monospace;
            font-size: 9px;
            font-weight: 700;

            letter-spacing: 0.08em;
        }

        /* BRAND */

        .error-brand {
            margin-top: 25px;

            text-align: center;

            color: #647466;

            font-family: monospace;
            font-size: 10px;
            letter-spacing: 0.16em;
        }

        .error-brand span {
            color: #39FF14;
        }

        /* RESPONSIVE */

        @media (max-width: 480px) {

            .error-terminal-body {
                padding: 40px 20px 28px;
            }

            .error-title {
                font-size: 18px;
            }

            .error-description {
                font-size: 11px;
            }

            .error-button {
                width: 100%;
            }

            .error-terminal-footer {
                font-size: 8px;
            }

        }

        /* REDUCED MOTION */

        @media (prefers-reduced-motion: reduce) {

            .error-button {
                transition: none;
            }

            .error-button:hover {
                transform: none;
            }

        }
        .error-title-glitch {
    position: relative;

    display: inline-block;
}

.error-title-glitch::before,
.error-title-glitch::after {
    content: attr(data-text);

    position: absolute;

    inset: 0;

    pointer-events: none;
}

.error-title-glitch::before {
    color: #FF2D55;

    animation: glitch-red 3s infinite;

    opacity: 0.7;
}

.error-title-glitch::after {
    color: #39FF14;

    animation: glitch-green 2.5s infinite;

    opacity: 0.7;
}

    </style>

</head>

<body class="antialiased">

    {{-- ==========================================
         MATRIX RAIN BACKGROUND
    ========================================== --}}

    <div class="matrix-container error-matrix" aria-hidden="true">

        <div class="matrix-pattern" data-matrix-pattern></div>

    </div>


    {{-- ==========================================
         404 ERROR CONTENT
    ========================================== --}}

    <main class="error-page">

        <div class="error-container">

            <div class="error-terminal">

                {{-- TERMINAL HEADER --}}

                <div class="error-terminal-header">

                    <span>SYSTEM_ERROR.sh</span>

                    <div class="error-terminal-dots">

                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </div>


                {{-- TERMINAL BODY --}}

                <div class="error-terminal-body">


                    {{-- ERROR NUMBER --}}

                    <h1 class="error-code">

                        <span class="error-glitch" data-text="404">
                            404
                        </span>

                    </h1>


                    {{-- ERROR TITLE --}}

                    <h2 class="error-title error-title-glitch" data-text="PAGE_NOT_FOUND">

                        PAGE_NOT_FOUND

                    </h2>


                    {{-- DESCRIPTION --}}

                    <p class="error-description">

                        Oops! The page you're looking for
                        doesn't exist, may have been moved,
                        or is temporarily unavailable.

                    </p>


                    {{-- ERROR INFO --}}

                    <div class="error-info">

                        <span>ERROR_CODE: 404</span>

                        <span>STATUS: NOT_FOUND</span>

                    </div>


                    {{-- ACTION BUTTONS --}}

                    <div class="error-actions">

                        {{-- GO BACK --}}

                        <button
                            type="button"
                            class="error-button error-button-secondary"
                            onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.assign('/'); }"
                        >

                            ← GO BACK

                        </button>


                        {{-- RETURN TO DASHBOARD / WELCOME --}}

                        @auth

                            <a href="{{ route('dashboard') }}"
                                class="error-button error-button-primary">

                                RETURN TO DASHBOARD →

                            </a>

                        @else

                            <a href="{{ url('/') }}"
                                class="error-button error-button-primary">

                                RETURN TO WELCOME →

                            </a>

                        @endauth

                    </div>

                </div>


                {{-- TERMINAL FOOTER --}}

                <div class="error-terminal-footer">

                    <span>REALORNOT AI</span>

                    <span>CONNECTION: ACTIVE</span>

                </div>

            </div>

        </div>

    </main>

</body>

</html>