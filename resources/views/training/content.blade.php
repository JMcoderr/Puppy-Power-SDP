@extends('layouts.app')

@section('content')
    {{-- protected page intro --}}
    <section class="page-head">
        <h1>Afgeschermde Trainingscontent</h1>
        <p>Alleen zichtbaar voor ingelogde gebruikers.</p>
    </section>

    <section class="cards-grid">
        @foreach ($lessons as $lesson)
            <article class="card">
                <h2>{{ $lesson['title'] }}</h2>
                <p>Video duur: {{ $lesson['duration'] }}</p>
                <a href="{{ route('contact.index') }}" class="btn btn-small">Vraag over deze les</a>
            </article>
        @endforeach
    </section>
@endsection
