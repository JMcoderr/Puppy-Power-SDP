@extends('layouts.app')

@section('content')
    {{-- protected page intro --}}
    <section class="mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Afgeschermde Trainingscontent</h1>
        <p class="mt-1 text-slate-600">Alleen zichtbaar voor ingelogde gebruikers.</p>
    </section>

    <section class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
        <p class="font-semibold">Ledenomgeving actief</p>
        <p class="mt-1">Bekijk hieronder de lessen. Voor persoonlijke feedback kun je altijd contact opnemen.</p>
    </section>

    <section class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($lessons as $lesson)
            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Les {{ $loop->iteration }}</p>
                <h2 class="text-xl font-semibold text-slate-900">{{ $lesson['title'] }}</h2>
                <p class="mt-2 text-slate-600">Video duur: {{ $lesson['duration'] }}</p>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800">Vraag over deze les</a>
            </article>
        @endforeach
    </section>
@endsection
