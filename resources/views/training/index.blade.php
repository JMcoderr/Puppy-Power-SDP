@extends('layouts.app')

@section('content')
    <section class="page-head">
        <h1>Training</h1>
        <p>Schrijf je in voor puppytraining, vuurwerkangst of gedragstraining.</p>
    </section>

    @if (session('status'))
        <p class="notice">{{ session('status') }}</p>
    @endif

    <section class="cards-grid">
        @foreach ($trainings as $training)
            <article class="card">
                <h2>{{ $training->title }}</h2>
                <p>{{ $training->summary }}</p>
                <p><strong>Start:</strong> {{ optional($training->starts_on)->format('d-m-Y') }}</p>
                <p><strong>Plekken:</strong> {{ $training->capacity }}</p>

                <form action="{{ route('training.enroll') }}" method="post" class="stack-form">
                    @csrf
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <label>Naam eigenaar
                        <input type="text" name="owner_name" required>
                    </label>
                    <label>E-mail
                        <input type="email" name="email" required>
                    </label>
                    <label>Naam hond
                        <input type="text" name="dog_name" required>
                    </label>
                    <label>Telefoon
                        <input type="text" name="phone">
                    </label>
                    <button type="submit" class="btn">Inschrijven</button>
                </form>
            </article>
        @endforeach
    </section>
@endsection
