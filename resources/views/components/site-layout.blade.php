<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        @if($title)
            {{ $title }} | BLAUG
        @else
            BLAUG
        @endif
    </title>

    @fonts

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        :root {
            --ink: #172554;
            --blue: #2563eb;
            --lime: #d9ff3f;
            --line: #cfdaf0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Archivo', ui-sans-serif, system-ui, sans-serif !important;
            background: #fff;
            color: var(--ink);
        }

        body .font-mono {
            font-family: 'Space Mono', ui-monospace, monospace !important;
        }

        *, *::before, *::after {
            border-radius: 0 !important;
        }

        ::selection {
            background: var(--lime);
            color: var(--ink);
        }

        .bg-stripes-blue {
            background-image: repeating-linear-gradient(
                90deg,
                rgba(37, 99, 235, 0.16) 0 2px,
                transparent 2px 12px
            );
        }

        .bg-stripes-ink {
            background-image: repeating-linear-gradient(
                90deg,
                rgba(23, 37, 84, 0.9) 0 2px,
                transparent 2px 10px
            );
        }

        .bg-stripes-white {
            background-image: repeating-linear-gradient(
                90deg,
                rgba(255, 255, 255, 0.18) 0 2px,
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

        .text-balance {
            text-wrap: balance;
        }
    </style>
</head>
<body class="bg-white font-sans text-blue-950 antialiased">

<div class="flex min-h-screen flex-col">
    <x-site-layout-header />

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-site-layout-footer />
</div>

</body>
</html>
