@extends('layouts.app')

@section('content')
    <section class="page-head">
        <h1>Contact</h1>
        <p>Vragen over training, shop of dagopvang? Stuur ons een bericht.</p>
    </section>

    @if (session('status'))
        <p class="notice">{{ session('status') }}</p>
    @endif

    <section class="card login-card">
        <form action="{{ route('contact.store') }}" method="post" class="stack-form">
            @csrf
            <label>Naam
                <input type="text" name="name" value="{{ old('name') }}" required>
            </label>
            <label>E-mail
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>Onderwerp
                <input type="text" name="subject" value="{{ old('subject') }}" required>
            </label>
            <label>Bericht
                <textarea name="message" rows="6" required>{{ old('message') }}</textarea>
            </label>
            <button type="submit" class="btn">Verstuur bericht</button>
        </form>
    </section>
@endsection
