@extends('layouts.app')

@section('content')
    {{-- quick intro block so users instantly know what this site is --}}
    <section class="fade-up card rounded-2xl p-6 md:p-8">
        <p class="mb-2 text-sm font-semibold text-emerald-700 dark:text-emerald-400">Jouw complete hondenplatform</p>
        <h1 class="mb-3 text-3xl font-bold text-slate-900 dark:text-white md:text-4xl">Welkom bij Puppy Power Academy</h1>
        <p class="max-w-2xl text-slate-600 dark:text-slate-400">
            Shop, training en dagopvang op een plek. Voor nieuwe en ervaren hondeneigenaren.
        </p>
        <div class="mt-5 flex flex-wrap gap-2">
            <a class="inline-flex rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600" href="{{ route('shop.index') }}">Bekijk de shop</a>
            <a class="inline-flex rounded-lg bg-sky-700 px-4 py-2 text-sm font-medium text-white hover:bg-sky-600" href="{{ route('training.index') }}">Bekijk trainingen</a>
            <a class="inline-flex rounded-lg bg-slate-700 px-4 py-2 text-sm font-medium text-white hover:bg-slate-600" href="{{ route('daycare.index') }}">Plan dagopvang</a>
        </div>
    </section>

    {{-- service cards like in the wireframe: each card has short text + action --}}
    <section class="mt-5 grid gap-4 md:grid-cols-3">
        <article class="fade-up fade-delay-1 card">
            <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Shop</h2>
            <p class="page-sub">Cursussen en DIY-pakketten die je direct kunt bestellen.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600" href="{{ route('shop.index') }}">Ga naar shop</a>
        </article>
        <article class="fade-up fade-delay-2 card">
            <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Training</h2>
            <p class="page-sub">Puppytraining, gedragstraining en hulp bij vuurwerkangst.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600" href="{{ route('training.index') }}">Ga naar training</a>
        </article>
        <article class="fade-up fade-delay-3 card">
            <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Dagopvang</h2>
            <p class="page-sub">Betrouwbare opvang met heldere planning en aanmeldingen.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600" href="{{ route('daycare.index') }}">Ga naar dagopvang</a>
        </article>
    </section>

    {{-- little extra info row so page feels complete --}}
    <section class="mt-4 grid gap-4 md:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-slate-100 p-5 dark:border-slate-700 dark:bg-slate-800">
            <h3 class="mb-2 text-lg font-semibold text-slate-900 dark:text-white">Voor wie?</h3>
            <p class="page-sub">Voor puppy-eigenaren en ervaren baasjes die structuur en hulp zoeken.</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-slate-100 p-5 dark:border-slate-700 dark:bg-slate-800">
            <h3 class="mb-2 text-lg font-semibold text-slate-900 dark:text-white">Hoe snel starten?</h3>
            <p class="page-sub">Je kunt direct een training kiezen of dagopvang aanvragen via de formulieren.</p>
        </article>
    </section>

    {{-- simple number cards so visitors see activity quickly --}}
    <section class="mt-4 grid gap-4 sm:grid-cols-2">
        <article class="card">
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Actieve producten in de shop</p>
            <p class="mt-1 text-3xl font-bold text-slate-900 dark:text-white">{{ $activeProducts ?? 0 }}</p>
            <a href="{{ route('shop.index') }}" class="mt-2 inline-block text-sm text-emerald-700 hover:underline dark:text-emerald-400">Bekijk shop &rarr;</a>
        </article>
        <article class="card">
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Actieve trainingen beschikbaar</p>
            <p class="mt-1 text-3xl font-bold text-slate-900 dark:text-white">{{ $activeTrainings ?? 0 }}</p>
            <a href="{{ route('training.index') }}" class="mt-2 inline-block text-sm text-emerald-700 hover:underline dark:text-emerald-400">Bekijk trainingen &rarr;</a>
        </article>
    </section>

    <section class="mt-5 card rounded-2xl p-6 md:p-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Zo werkt het in 3 stappen</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-3">
            <article class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-800 dark:bg-emerald-950">
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Stap 1</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Kies je doel</h3>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Wil je trainen, dagopvang plannen of direct materiaal bestellen?</p>
            </article>
            <article class="rounded-xl border border-sky-200 bg-sky-50 p-4 dark:border-sky-800 dark:bg-sky-950">
                <p class="text-xs font-semibold uppercase tracking-wide text-sky-700 dark:text-sky-400">Stap 2</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Meld je online aan</h3>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Met het formulier regelen we intake, planning en eventuele vragen.</p>
            </article>
            <article class="rounded-xl border border-amber-200 bg-amber-50 p-4 dark:border-amber-800 dark:bg-amber-950">
                <p class="text-xs font-semibold uppercase tracking-wide text-amber-700 dark:text-amber-400">Stap 3</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Start samen</h3>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Je krijgt begeleiding en praktische tips voor jou en je hond.</p>
            </article>
        </div>
    </section>

    <section class="mt-5 grid gap-4 lg:grid-cols-[1.3fr_0.7fr]">
        <article class="card">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Waarom klanten kiezen voor ons</p>
            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-700/50">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Persoonlijk</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Advies dat past bij het gedrag en tempo van jouw hond.</p>
                </div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-700/50">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Praktisch</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Duidelijke oefeningen die je meteen thuis kunt toepassen.</p>
                </div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-700/50">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Veilig</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Rustige opbouw en aandacht voor welzijn en vertrouwen.</p>
                </div>
            </div>
        </article>

        <aside class="card">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Snel starten?</h2>
            <p class="mt-2 page-sub">Kies de route die nu het beste bij je past en zet vandaag de eerste stap.</p>
            <div class="mt-4 grid gap-2">
                <a href="{{ route('training.index') }}" class="inline-flex justify-center rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600">Start met training</a>
                <a href="{{ route('daycare.index') }}" class="inline-flex justify-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">Bekijk dagopvang</a>
            </div>
        </aside>
    </section>
@endsection
