@extends('layouts.app')

@section('content')
    <section class="page-head">
        <h1>Dagopvang</h1>
        <p>Veilige, professionele opvang met overzichtelijke planning en intake.</p>
    </section>

    @if (session('status'))
        <p class="notice">{{ session('status') }}</p>
    @endif

    <section class="cards-grid">
        <article class="card">
            <h2>Beschikbare planning</h2>
            <ul>
                @foreach ($schedule as $slot)
                    <li>{{ $slot['date'] }} - {{ $slot['available'] }}</li>
                @endforeach
            </ul>
        </article>

        <article class="card">
            <h2>Aanmelding dagopvang</h2>
            <form action="{{ route('daycare.store') }}" method="post" class="stack-form">
                @csrf
                <label>Naam eigenaar
                    <input type="text" name="owner_name" required>
                </label>
                <label>E-mail
                    <input type="email" name="email" required>
                </label>
                <label>Naam hond
                    <input type="text" name="dog_name" required>
                </label>
                <label>Datum opvang
                    <input type="date" name="drop_off_date" required>
                </label>
                <label>Dagdeel
                    <select name="time_slot" required>
                        <option value="Ochtend">Ochtend</option>
                        <option value="Middag">Middag</option>
                        <option value="Hele dag">Hele dag</option>
                    </select>
                </label>
                <label>Notities
                    <textarea name="notes" rows="4"></textarea>
                </label>
                <button type="submit" class="btn">Aanmelden</button>
            </form>
        </article>
    </section>
@endsection
