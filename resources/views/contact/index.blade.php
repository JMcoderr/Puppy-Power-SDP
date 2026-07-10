@extends('layouts.app')

@section('content')
    {{-- page intro --}}
    <section class="mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Contact</h1>
        <p class="mt-1 text-slate-600">Vragen over training, shop of dagopvang? Stuur ons een bericht.</p>
    </section>

    @if (session('status'))
        <p class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-900">{{ session('status') }}</p>
    @endif

    @include('partials.form-error-summary')

    <section class="grid gap-4 lg:grid-cols-[2fr_1fr]">
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">We reageren meestal binnen 1 werkdag.</p>
        <form action="{{ route('contact.store') }}" method="post" class="mt-4 grid gap-3">
            @csrf
            <label class="grid gap-1 text-sm">Naam
                <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required>
            </label>
            @error('name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">E-mail
                <input class="rounded-md border border-slate-300 px-3 py-2" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
            </label>
            @error('email') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">Onderwerp
                {{-- dropdown keeps subject values consistent in the admin dashboard --}}
                <select class="rounded-md border border-slate-300 px-3 py-2" name="subject" required>
                    <option value="" disabled @selected(! old('subject'))>Kies een onderwerp…</option>
                    <option value="Vraag over training" @selected(old('subject') === 'Vraag over training')>Vraag over training</option>
                    <option value="Vraag over dagopvang" @selected(old('subject') === 'Vraag over dagopvang')>Vraag over dagopvang</option>
                    <option value="Vraag over een product" @selected(old('subject') === 'Vraag over een product')>Vraag over een product</option>
                    <option value="Overige vraag" @selected(old('subject') === 'Overige vraag')>Overige vraag</option>
                </select>
            </label>
            @error('subject') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">Bericht
                <textarea class="rounded-md border border-slate-300 px-3 py-2" name="message" rows="6" required>{{ old('message') }}</textarea>
            </label>
            @error('message') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Verstuur bericht</button>
        </form>
        </article>

        <aside class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Directe tips</h2>
            <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-slate-600">
                <li>Omschrijf het gedrag van je hond kort en concreet.</li>
                <li>Vermeld leeftijd, ras en situatie thuis.</li>
                <li>Zet erbij wanneer je wilt starten.</li>
            </ul>
            <p class="mt-4 text-sm text-slate-500">Zo kunnen we je sneller en gerichter helpen.</p>
        </aside>
    </section>
@endsection
