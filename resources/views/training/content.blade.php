@extends('layouts.app')

@section('content')
    {{-- protected page intro --}}
    <section class="mb-4">
        <h1 class="page-heading">Afgeschermde Trainingscontent</h1>
        <p class="page-sub mt-1">Alleen zichtbaar voor ingelogde gebruikers.</p>
    </section>

    <section class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
        <p class="font-semibold">Ledenomgeving actief</p>
        <p class="mt-1">Bekijk hieronder de lessen. Voor persoonlijke feedback kun je altijd contact opnemen.</p>
    </section>

    <section class="mb-4 grid gap-4 lg:grid-cols-[1.4fr_2fr]">
        <article class="card">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Voortgang</p>
            <h2 class="mt-1 text-xl font-semibold text-slate-900 dark:text-white">Jouw trainingspad</h2>
            <p class="mt-2 page-sub">Werk de lessen in volgorde af voor de beste opbouw in focus, wandelen en prikkelverwerking.</p>

            <div class="mt-4 h-3 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-700">
                <div class="h-full w-1/3 rounded-full bg-emerald-500"></div>
            </div>

            <div class="mt-4 grid gap-3 sm:grid-cols-3 lg:grid-cols-1">
                @foreach ($lessons as $lesson)
                    <div class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 dark:border-slate-700 dark:bg-slate-700/50">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ $lesson['level'] }}</p>
                        <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $lesson['status'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>

        <article class="card">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Lessenoverzicht</h2>
            <p class="mt-2 page-sub">Iedere les bouwt verder op de vorige stap. Bekijk de duur en volgorde hieronder.</p>

            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 dark:border-emerald-800 dark:bg-emerald-950">
                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Totale lessen</p>
                    <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ count($lessons) }}</p>
                </div>
                <div class="rounded-lg border border-sky-200 bg-sky-50 px-4 py-3 dark:border-sky-800 dark:bg-sky-950">
                    <p class="text-xs font-semibold uppercase tracking-wide text-sky-700 dark:text-sky-400">Geschatte tijd</p>
                    <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">62 min</p>
                </div>
                <div class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 dark:border-amber-800 dark:bg-amber-950">
                    <p class="text-xs font-semibold uppercase tracking-wide text-amber-700 dark:text-amber-400">Aanbevolen tempo</p>
                    <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">1 p/w</p>
                </div>
            </div>
        </article>
    </section>

    <section class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($lessons as $lesson)
            <article class="card">
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Les {{ $loop->iteration }}</p>
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $lesson['title'] }}</h2>
                <p class="mt-2 page-sub">Video duur: {{ $lesson['duration'] }}</p>
                <div class="mt-3 inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700 dark:border-slate-700 dark:bg-slate-700 dark:text-slate-200">{{ $lesson['status'] }}</div>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600">Vraag over deze les</a>
            </article>
        @endforeach
    </section>
@endsection
