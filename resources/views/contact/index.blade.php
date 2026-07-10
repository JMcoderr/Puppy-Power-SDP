@extends('layouts.app')

@section('content')
    {{-- page intro --}}
    <section class="page-head">
        <h1>Contact</h1>
        <p>Vragen over training, shop of dagopvang? Stuur ons een bericht.</p>
    </section>

    @if (session('status'))
        <p class="notice">{{ session('status') }}</p>
    @endif

    <section class="card login-card">
        <p class="hint">We reageren meestal binnen 1 werkdag.</p>
        <form action="{{ route('contact.store') }}" method="post" class="stack-form">
            @csrf
            <label>Naam
                <input type="text" name="name" value="{{ old('name') }}" required>
            </label>
            @error('name') <p class="error">{{ $message }}</p> @enderror
            <label>E-mail
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            @error('email') <p class="error">{{ $message }}</p> @enderror
            <label>Onderwerp
                <input type="text" name="subject" value="{{ old('subject') }}" required>
            </label>
            @error('subject') <p class="error">{{ $message }}</p> @enderror
            <label>Bericht
                <textarea name="message" rows="6" required>{{ old('message') }}</textarea>
            </label>
            @error('message') <p class="error">{{ $message }}</p> @enderror
            <button type="submit" class="btn">Verstuur bericht</button>
        </form>
    </section>
@endsection
