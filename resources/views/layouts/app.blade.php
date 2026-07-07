<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Puppy Power Academy' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a href="{{ route('home') }}" class="brand">Puppy Power Academy</a>
            <nav class="main-nav">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('shop.index') }}">Shop</a>
                <a href="#">Training</a>
                <a href="#">Dagopvang</a>
                <a href="#">Contact</a>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        @yield('content')
    </main>
</body>
</html>
