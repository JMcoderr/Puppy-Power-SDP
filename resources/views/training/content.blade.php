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

    <section class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($lessons as $lesson)
            <article class="card">
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Les {{ $loop->iteration }}</p>
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $lesson['title'] }}</h2>
                <p class="mt-2 page-sub">Video duur: {{ $lesson['duration'] }}</p>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600">Vraag over deze les</a>
            </article>
        @endforeach
    </section>
@endsection
