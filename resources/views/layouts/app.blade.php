<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Puppy Power Academy' }}</title>
    {{-- anti-flash: apply saved theme before the browser paints to avoid white flash --}}
    <script>
        (function(){
            var t=localStorage.getItem('theme');
            var d=window.matchMedia('(prefers-color-scheme: dark)').matches;
            if(t==='dark'||(t===null&&d))document.documentElement.classList.add('dark');
        })();
    </script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-200">
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

    <div class="border-b border-emerald-200/70 bg-emerald-50/80 backdrop-blur dark:border-emerald-900 dark:bg-emerald-950/60">
        <div class="mx-auto flex w-full max-w-6xl flex-col gap-2 px-4 py-2 text-sm text-emerald-900 dark:text-emerald-300 md:flex-row md:items-center md:justify-between">
            <p>Persoonlijke begeleiding, snelle reactie en een compleet aanbod voor hond en eigenaar.</p>
            <div class="flex flex-wrap gap-3 text-xs font-medium uppercase tracking-wide">
                <span>Binnen 1 werkdag reactie</span>
                <span>Training, shop en dagopvang</span>
                <span>Veilige en praktische aanpak</span>
            </div>
        </div>
    </div>

    {{-- simple fixed header with nav --}}
    <header class="border-b border-slate-200 bg-white/95 backdrop-blur dark:border-slate-700 dark:bg-slate-800/95">
        <div class="mx-auto flex w-full max-w-6xl flex-col gap-3 px-4 py-4 md:flex-row md:items-center md:justify-between">
            <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-slate-900 dark:text-white">Puppy Power Academy</a>
            <nav class="flex flex-wrap items-center gap-1 text-sm md:gap-2">
                <a href="{{ route('home') }}" aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('home') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Home</a>
                <a href="{{ route('shop.index') }}" aria-current="{{ request()->routeIs('shop.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('shop.*') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Shop</a>
                <a href="{{ route('training.index') }}" aria-current="{{ request()->routeIs('training.index') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('training.index') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Training</a>
                <a href="{{ route('daycare.index') }}" aria-current="{{ request()->routeIs('daycare.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('daycare.*') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Dagopvang</a>
                <a href="{{ route('contact.index') }}" aria-current="{{ request()->routeIs('contact.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('contact.*') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Contact</a>
                @auth
                    <a href="{{ route('account.index') }}" aria-current="{{ request()->routeIs('account.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('account.*') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Mijn account</a>
                    {{-- training content link is visible to all logged-in users --}}
                    <a href="{{ route('training.content') }}" aria-current="{{ request()->routeIs('training.content') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('training.content') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Training content</a>
                    {{-- beheer link is only shown to admin users --}}
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('beheer.index') }}" aria-current="{{ request()->routeIs('beheer.*') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('beheer.*') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Beheer</a>
                    @endif
                    <form action="{{ route('logout') }}" method="post" style="display:inline;">
                        @csrf
                        <button type="submit" class="link-button rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700">Uitloggen</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" aria-current="{{ request()->routeIs('login') ? 'page' : 'false' }}" class="rounded-md px-3 py-2 {{ request()->routeIs('login') ? 'is-active bg-emerald-100 text-emerald-900 dark:bg-emerald-900 dark:text-emerald-200' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700' }}">Inloggen</a>
                @endauth

                {{-- light/dark theme toggle button --}}
                <button
                    id="theme-toggle-btn"
                    onclick="toggleTheme()"
                    aria-label="Schakel naar donker thema"
                    class="rounded-md px-2 py-2 text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700"
                >
                    &#127769; {{-- moon icon in light mode, sun in dark --}}
                </button>
            </nav>
        </div>
    </header>

    <main id="main-content" class="mx-auto w-full max-w-6xl px-4 py-8 md:py-10">
        @yield('content')
    </main>

    <div class="sticky bottom-0 z-20 border-t border-slate-200 bg-white/95 px-4 py-3 shadow-[0_-8px_30px_rgba(15,23,42,0.08)] backdrop-blur dark:border-slate-700 dark:bg-slate-900/95 lg:hidden">
        <div class="mx-auto flex w-full max-w-6xl gap-2">
            <a href="{{ route('training.index') }}" class="btn-primary flex-1">Training</a>
            <a href="{{ route('daycare.index') }}" class="btn-secondary flex-1">Dagopvang</a>
            <a href="{{ route('contact.index') }}" class="btn-dark flex-1">Contact</a>
        </div>
    </div>

    {{-- footer uses a soft card-like light theme and switches to dark in dark mode --}}
    <footer class="mt-8 border-t border-slate-200 bg-linear-to-br from-white via-slate-50 to-emerald-50 pb-20 text-slate-700 dark:border-slate-700 dark:bg-none dark:bg-slate-950 dark:text-slate-300 lg:pb-0">
        <div class="mx-auto w-full max-w-6xl px-4 pt-10 pb-6">

            {{-- top row: four columns --}}
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">

                {{-- column 1: branding and short description --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-slate-900 hover:text-emerald-700 dark:text-white dark:hover:text-emerald-400">
                        Puppy Power Academy
                    </a>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                        Alles voor jou en je hond op één plek. Shop, training en dagopvang.
                    </p>
                    {{-- simple visual accent strip --}}
                    <div class="mt-4 h-1 w-10 rounded-full bg-emerald-500"></div>
                </div>

                {{-- column 2: page links --}}
                <nav aria-label="Footer navigatie">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Navigatie</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="{{ route('home') }}"           class="hover:text-emerald-700 transition-colors dark:hover:text-emerald-400">Home</a></li>
                        <li><a href="{{ route('shop.index') }}"     class="hover:text-emerald-700 transition-colors dark:hover:text-emerald-400">Shop</a></li>
                        <li><a href="{{ route('training.index') }}" class="hover:text-emerald-700 transition-colors dark:hover:text-emerald-400">Training</a></li>
                        <li><a href="{{ route('daycare.index') }}"  class="hover:text-emerald-700 transition-colors dark:hover:text-emerald-400">Dagopvang</a></li>
                        <li><a href="{{ route('contact.index') }}"  class="hover:text-emerald-700 transition-colors dark:hover:text-emerald-400">Contact</a></li>
                    </ul>
                </nav>

                {{-- column 3: opening hours --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Openingstijden</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li class="flex justify-between gap-4"><span>Maandag – vrijdag</span><span class="text-slate-500 dark:text-slate-400">09:00 – 17:00</span></li>
                        <li class="flex justify-between gap-4"><span>Zaterdag</span><span class="text-slate-500 dark:text-slate-400">10:00 – 14:00</span></li>
                        <li class="flex justify-between gap-4"><span>Zondag</span><span class="text-slate-500 dark:text-slate-400">Gesloten</span></li>
                    </ul>
                </div>

                {{-- column 4: contact details --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Contact</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li>
                            <a href="mailto:info@puppypoweracademy.nl" class="hover:text-emerald-700 transition-colors dark:hover:text-emerald-400">
                                info@puppypoweracademy.nl
                            </a>
                        </li>
                        <li>Reactie binnen 1 werkdag</li>
                        <li>
                            <a href="{{ route('contact.index') }}" class="mt-1 inline-flex rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-emerald-500 transition-colors shadow-sm shadow-emerald-200 dark:shadow-none">
                                Stuur een bericht
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- small service highlights so the footer feels more complete --}}
            <div class="mt-8 flex flex-wrap gap-2 border-t border-slate-200 pt-5 dark:border-slate-700">
                <span class="rounded-full border border-emerald-200 bg-white px-3 py-1 text-xs font-medium text-emerald-800 shadow-sm dark:border-emerald-800 dark:bg-slate-800 dark:text-emerald-300 dark:shadow-none">Persoonlijk advies</span>
                <span class="rounded-full border border-sky-200 bg-white px-3 py-1 text-xs font-medium text-sky-800 shadow-sm dark:border-sky-800 dark:bg-slate-800 dark:text-sky-300 dark:shadow-none">Snelle reactie</span>
                <span class="rounded-full border border-amber-200 bg-white px-3 py-1 text-xs font-medium text-amber-800 shadow-sm dark:border-amber-800 dark:bg-slate-800 dark:text-amber-300 dark:shadow-none">Veilige dagopvang</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-medium text-slate-700 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:shadow-none">Training op maat</span>
            </div>

            {{-- bottom bar with copyright --}}
            <div class="mt-8 flex flex-col items-center justify-between gap-2 border-t border-slate-200 pt-5 text-xs text-slate-500 dark:border-slate-700 dark:text-slate-400 sm:flex-row">
                <p>&copy; {{ date('Y') }} Puppy Power Academy. Alle rechten voorbehouden.</p>
                <a href="#main-content" class="hover:text-emerald-700 dark:hover:text-emerald-400">Naar boven</a>
            </div>
        </div>
    </footer>
</body>
</html>
