@extends('layouts.app')

@section('content')
    {{-- protected page intro --}}
    <section class="page-head mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Afgeschermde Trainingscontent</h1>
        <p class="mt-1 text-slate-600">Alleen zichtbaar voor ingelogde gebruikers.</p>
    </section>

    <section class="cards-grid grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($lessons as $lesson)
            <article class="card rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900">{{ $lesson['title'] }}</h2>
                <p class="mt-2 text-slate-600">Video duur: {{ $lesson['duration'] }}</p>
                <a href="{{ route('contact.index') }}" class="btn btn-small mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800">Vraag over deze les</a>
            </article>
        @endforeach
    </section>
@endsection
