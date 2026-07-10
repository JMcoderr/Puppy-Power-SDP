@extends('layouts.app')

@section('content')
    {{-- intro for daycare section --}}
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
            <ul class="schedule-list">
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
                <label>Datum opvang
                    <input type="date" name="drop_off_date" value="{{ old('drop_off_date') }}" required>
                </label>
                @error('drop_off_date') <p class="error">{{ $message }}</p> @enderror
                <label>Dagdeel
                    <select name="time_slot" required>
                        <option value="Ochtend" @selected(old('time_slot') === 'Ochtend')>Ochtend</option>
                        <option value="Middag" @selected(old('time_slot') === 'Middag')>Middag</option>
                        <option value="Hele dag" @selected(old('time_slot') === 'Hele dag')>Hele dag</option>
                    </select>
                </label>
                @error('time_slot') <p class="error">{{ $message }}</p> @enderror
                <label>Notities
                    <textarea name="notes" rows="4">{{ old('notes') }}</textarea>
                </label>
                @error('notes') <p class="error">{{ $message }}</p> @enderror
                <button type="submit" class="btn">Aanmelden</button>
            </form>
        </article>
    </section>
@endsection
