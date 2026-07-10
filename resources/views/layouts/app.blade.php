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
    {{-- simple fixed header with nav --}}
    <header class="site-header">
        <div class="container nav-wrap">
            <a href="{{ route('home') }}" class="brand">Puppy Power Academy</a>
            <nav class="main-nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
                <a href="{{ route('shop.index') }}" class="{{ request()->routeIs('shop.*') ? 'is-active' : '' }}">Shop</a>
                <a href="{{ route('training.index') }}" class="{{ request()->routeIs('training.index') ? 'is-active' : '' }}">Training</a>
                <a href="{{ route('daycare.index') }}" class="{{ request()->routeIs('daycare.*') ? 'is-active' : '' }}">Dagopvang</a>
                <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'is-active' : '' }}">Contact</a>
                @auth
                    <a href="{{ route('training.content') }}" class="{{ request()->routeIs('training.content') ? 'is-active' : '' }}">Training content</a>
                    <a href="{{ route('beheer.index') }}" class="{{ request()->routeIs('beheer.*') ? 'is-active' : '' }}">Beheer</a>
                    <form action="{{ route('logout') }}" method="post" style="display:inline;">
                        @csrf
                        <button type="submit" class="link-button">Uitloggen</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'is-active' : '' }}">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container page-content">
        @yield('content')
    </main>

    {{-- quick footer with basic info --}}
    <footer class="site-footer">
        <div class="container footer-wrap">
            <p>Puppy Power Academy - Shop, training en dagopvang op 1 plek.</p>
        </div>
    </footer>
</body>
</html>
