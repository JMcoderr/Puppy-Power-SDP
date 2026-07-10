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
<body class="min-h-screen bg-slate-50 text-slate-800">
    {{-- simple fixed header with nav --}}
    <header class="site-header border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="container nav-wrap flex flex-col gap-3 py-4 md:flex-row md:items-center md:justify-between">
            <a href="{{ route('home') }}" class="brand text-lg font-bold tracking-tight text-slate-900">Puppy Power Academy</a>
            <nav class="main-nav flex flex-wrap items-center gap-1 text-sm md:gap-2">
                <a href="{{ route('home') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('home') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Home</a>
                <a href="{{ route('shop.index') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('shop.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Shop</a>
                <a href="{{ route('training.index') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('training.index') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Training</a>
                <a href="{{ route('daycare.index') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('daycare.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Dagopvang</a>
                <a href="{{ route('contact.index') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('contact.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Contact</a>
                @auth
                    <a href="{{ route('training.content') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('training.content') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Training content</a>
                    <a href="{{ route('beheer.index') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('beheer.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Beheer</a>
                    <form action="{{ route('logout') }}" method="post" style="display:inline;">
                        @csrf
                        <button type="submit" class="link-button rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100">Uitloggen</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-md px-3 py-2 {{ request()->routeIs('login') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container page-content py-8 md:py-10">
        @yield('content')
    </main>

    {{-- quick footer with basic info --}}
    <footer class="site-footer border-t border-slate-200 bg-white">
        <div class="container footer-wrap py-4 text-sm text-slate-500">
            <p>Puppy Power Academy - Shop, training en dagopvang op 1 plek.</p>
        </div>
    </footer>
</body>
</html>
