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
    <a
        href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:rounded-md focus:bg-white focus:px-3 focus:py-2 focus:text-slate-900 focus:shadow"
        style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;"
        onfocus="this.style.left='1rem';this.style.top='1rem';this.style.width='auto';this.style.height='auto';"
        onblur="this.style.left='-9999px';this.style.top='auto';this.style.width='1px';this.style.height='1px';"
    >
        Ga naar hoofdinhoud
    </a>

    @unless (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        <div class="border-b border-amber-200 bg-amber-50 px-4 py-2 text-sm text-amber-900">
            Frontend assets are missing. Run <strong>npm run dev</strong> or <strong>npm run build</strong>.
        </div>
    @endunless

    {{-- simple fixed header with nav --}}
    <header class="border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex w-full max-w-6xl flex-col gap-3 px-4 py-4 md:flex-row md:items-center md:justify-between">
            <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-slate-900">Puppy Power Academy</a>
            <nav class="flex flex-wrap items-center gap-1 text-sm md:gap-2">
                <a href="{{ route('home') }}" aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('home') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Home</a>
                <a href="{{ route('shop.index') }}" aria-current="{{ request()->routeIs('shop.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('shop.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Shop</a>
                <a href="{{ route('training.index') }}" aria-current="{{ request()->routeIs('training.index') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('training.index') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Training</a>
                <a href="{{ route('daycare.index') }}" aria-current="{{ request()->routeIs('daycare.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('daycare.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Dagopvang</a>
                <a href="{{ route('contact.index') }}" aria-current="{{ request()->routeIs('contact.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('contact.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Contact</a>
                @auth
                    {{-- training content link is visible to all logged-in users --}}
                    <a href="{{ route('training.content') }}" aria-current="{{ request()->routeIs('training.content') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('training.content') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Training content</a>
                    {{-- beheer link is only shown to admin users --}}
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('beheer.index') }}" aria-current="{{ request()->routeIs('beheer.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('beheer.*') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Beheer</a>
                    @endif
                    <form action="{{ route('logout') }}" method="post" style="display:inline;">
                        @csrf
                        <button type="submit" class="link-button rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100">Uitloggen</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" aria-current="{{ request()->routeIs('login') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('login') ? 'is-active bg-emerald-100 text-emerald-900' : 'text-slate-700 hover:bg-slate-100' }}">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <main id="main-content" class="mx-auto w-full max-w-6xl px-4 py-8 md:py-10">
        @yield('content')
    </main>

    {{-- rich footer with dark background, four columns and a bottom bar --}}
    <footer class="mt-8 bg-slate-900 text-slate-300">
        <div class="mx-auto w-full max-w-6xl px-4 pt-10 pb-6">

            {{-- top row: four columns --}}
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">

                {{-- column 1: branding and short description --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-white hover:text-emerald-400">
                        Puppy Power Academy
                    </a>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">
                        Alles voor jou en je hond op één plek. Shop, training en dagopvang.
                    </p>
                    {{-- simple visual accent strip --}}
                    <div class="mt-4 h-1 w-10 rounded-full bg-emerald-500"></div>
                </div>

                {{-- column 2: page links --}}
                <nav aria-label="Footer navigatie">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Navigatie</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="{{ route('home') }}"           class="hover:text-emerald-400 transition-colors">Home</a></li>
                        <li><a href="{{ route('shop.index') }}"     class="hover:text-emerald-400 transition-colors">Shop</a></li>
                        <li><a href="{{ route('training.index') }}" class="hover:text-emerald-400 transition-colors">Training</a></li>
                        <li><a href="{{ route('daycare.index') }}"  class="hover:text-emerald-400 transition-colors">Dagopvang</a></li>
                        <li><a href="{{ route('contact.index') }}"  class="hover:text-emerald-400 transition-colors">Contact</a></li>
                    </ul>
                </nav>

                {{-- column 3: opening hours --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Openingstijden</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li class="flex justify-between gap-4"><span>Maandag – vrijdag</span><span class="text-slate-400">09:00 – 17:00</span></li>
                        <li class="flex justify-between gap-4"><span>Zaterdag</span><span class="text-slate-400">10:00 – 14:00</span></li>
                        <li class="flex justify-between gap-4"><span>Zondag</span><span class="text-slate-400">Gesloten</span></li>
                    </ul>
                </div>

                {{-- column 4: contact details --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Contact</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li>
                            <a href="mailto:info@puppypoweracademy.nl" class="hover:text-emerald-400 transition-colors">
                                info@puppypoweracademy.nl
                            </a>
                        </li>
                        <li>Reactie binnen 1 werkdag</li>
                        <li>
                            <a href="{{ route('contact.index') }}" class="mt-1 inline-flex rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-emerald-500 transition-colors">
                                Stuur een bericht
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- bottom bar with copyright --}}
            <div class="mt-8 flex flex-col items-center justify-between gap-2 border-t border-slate-700 pt-5 text-xs text-slate-500 sm:flex-row">
                <p>&copy; {{ date('Y') }} Puppy Power Academy. Alle rechten voorbehouden.</p>
                <p>Gebouwd met Laravel &amp; Tailwind CSS</p>
            </div>
        </div>
    </footer>
</body>
</html>
