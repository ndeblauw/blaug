<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @fonts

    <!-- Styles / Scripts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    -->
</head>
<body class="">

<div>
    <div style="background-color: lightblue;">
        Logo  +
        <a href="{{route('articles.index')}}">Articles</a> +
        Contact +
        Login +
        <hr/>
    </div>

    <main>
        {{$slot}}
    </main>

    <div>
        <hr/>
        This is my footer
    </div>
</div>

</body>
</html>
