@extends('layouts.app')

@section('content')
    {{-- quick heading and context --}}
    <section class="page-head">
        <h1>Training</h1>
        <p>Schrijf je in voor puppytraining, vuurwerkangst of gedragstraining.</p>
    </section>

    @if (session('status'))
        <p class="notice">{{ session('status') }}</p>
    @endif

    <section class="cards-grid">
        @forelse ($trainings as $training)
            <article class="card">
                <h2>{{ $training->title }}</h2>
                <p>{{ $training->summary }}</p>
                <p><strong>Start:</strong> {{ optional($training->starts_on)->format('d-m-Y') }}</p>
                <p><strong>Plekken:</strong> {{ $training->capacity }}</p>

                <form action="{{ route('training.enroll') }}" method="post" class="stack-form">
                    @csrf
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <label>Naam eigenaar
                        <input type="text" name="owner_name" value="{{ old('owner_name') }}" required>
                    </label>
                    @error('owner_name') <p class="error">{{ $message }}</p> @enderror
                    <label>E-mail
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </label>
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                    <label>Naam hond
                        <input type="text" name="dog_name" value="{{ old('dog_name') }}" required>
                    </label>
                    @error('dog_name') <p class="error">{{ $message }}</p> @enderror
                    <label>Telefoon
                        <input type="text" name="phone" value="{{ old('phone') }}">
                    </label>
                    @error('phone') <p class="error">{{ $message }}</p> @enderror
                    <label>Notities
                        <textarea name="notes" rows="3">{{ old('notes') }}</textarea>
                    </label>
                    @error('notes') <p class="error">{{ $message }}</p> @enderror
                    <button type="submit" class="btn">Inschrijven</button>
                </form>
            </article>
        @empty
            <article class="card">
                <h2>Geen actieve trainingen</h2>
                <p>Op dit moment zijn er geen trainingen beschikbaar.</p>
            </article>
        @endforelse
    </section>
@endsection
