<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BLAUG') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
        @endif

        <style>
            body {
                font-family: 'Archivo', ui-sans-serif, system-ui, sans-serif !important;
                background: #fff;
                color: #172554;
            }

            body .font-mono {
                font-family: 'Space Mono', ui-monospace, monospace !important;
            }

            *, *::before, *::after {
                border-radius: 0 !important;
            }

            .bg-stripes-white {
                background-image: repeating-linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.18) 0 2px,
                    transparent 2px 12px
                );
            }

            .bg-stripes-blue {
                background-image: repeating-linear-gradient(
                    90deg,
                    rgba(37, 99, 235, 0.16) 0 2px,
                    transparent 2px 12px
                );
            }

            .bg-stripes-lime {
                background-image: repeating-linear-gradient(
                    90deg,
                    rgba(217, 255, 63, 0.95) 0 2px,
                    transparent 2px 12px
                );
            }

            ::selection {
                background: #d9ff3f;
                color: #172554;
            }
        </style>
    </head>
    <body class="font-sans text-blue-950 antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-2">
            <aside class="relative hidden overflow-hidden bg-blue-950 p-12 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="bg-stripes-white absolute inset-0 opacity-60" aria-hidden="true"></div>

                <a href="{{ route('welcome') }}" class="relative inline-flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center bg-[#d9ff3f] text-lg font-black text-blue-950">B</span>
                    <span class="text-2xl font-black uppercase tracking-[-0.05em]">BLAUG</span>
                </a>

                <div class="relative">
                    <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-[#d9ff3f]">Members only</p>
                    <p class="mt-5 text-6xl font-black uppercase leading-[0.88] tracking-[-0.05em]">
                        Read<br>
                        the<br>
                        news.
                    </p>
                    <p class="mt-6 max-w-xs text-sm leading-7 text-blue-100/70">
                        Sign in to comment, publish and keep the conversation going.
                    </p>
                </div>

                <p class="relative font-mono text-[10px] uppercase tracking-[0.2em] text-blue-100/50">
                    BLAUG &copy; {{ date('Y') }}
                </p>
            </aside>

            <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-16">
                <a href="{{ route('welcome') }}" class="mb-10 inline-flex items-center gap-3 lg:hidden">
                    <span class="flex h-10 w-10 items-center justify-center bg-blue-950 text-lg font-black text-white">B</span>
                    <span class="text-2xl font-black uppercase tracking-[-0.05em] text-blue-950">BLAUG</span>
                </a>

                <div class="mx-auto w-full max-w-md">
                    <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-blue-600">Your account</p>
                    <h1 class="mt-3 text-3xl font-black uppercase tracking-[-0.03em] text-blue-950">
                        Welcome to BLAUG
                    </h1>

                    <div class="relative mt-8">
                        <div class="bg-stripes-blue absolute -left-2 -top-2 h-full w-full" aria-hidden="true"></div>

                        <div class="relative border-2 border-blue-950 bg-white p-6 sm:p-8">
                            {{ $slot }}
                        </div>
                    </div>

                    <p class="mt-8 font-mono text-[10px] uppercase tracking-[0.18em] text-blue-950/40">
                        No algorithms. No rounded corners.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
