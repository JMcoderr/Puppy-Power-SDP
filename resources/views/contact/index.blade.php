@extends('layouts.app')

@section('content')
    {{-- page intro --}}
    <section class="mb-4">
        <h1 class="page-heading">Contact</h1>
        <p class="page-sub mt-1">Vragen over training, shop of dagopvang? Stuur ons een bericht.</p>
    </section>

    @if (session('status'))
        <p class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-900 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">{{ session('status') }}</p>
    @endif

    @include('partials.form-error-summary')

    <section class="mb-4 grid gap-4 md:grid-cols-3">
        <article class="card p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Snelle route</p>
            <h2 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Training</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Gebruik dit als je hulp wilt bij gedrag, focus of wandeltraining.</p>
            <p class="mt-3 inline-flex w-fit rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Vraag over training</p>
        </article>
        <article class="card p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-sky-700 dark:text-sky-400">Snelle route</p>
            <h2 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Dagopvang</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Gebruik dit als je vragen hebt over planning, intake of beschikbare plaatsen.</p>
            <p class="mt-3 inline-flex w-fit rounded-full bg-sky-50 px-3 py-1 text-xs font-medium text-sky-800 dark:bg-sky-950 dark:text-sky-300">Vraag over dagopvang</p>
        </article>
        <article class="card p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-amber-700 dark:text-amber-400">Snelle route</p>
            <h2 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Producten</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Gebruik dit als je twijfelt tussen producten of advies wilt voor je situatie.</p>
            <p class="mt-3 inline-flex w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-amber-800 dark:bg-amber-950 dark:text-amber-300">Vraag over een product</p>
        </article>
    </section>

    <section class="grid gap-4 lg:grid-cols-[2fr_1fr]">
        <article class="card">
        <p class="text-sm text-slate-500 dark:text-slate-400">We reageren meestal binnen 1 werkdag.</p>
        <form action="{{ route('contact.store') }}" method="post" class="mt-4 grid gap-3">
            @csrf
            <label class="grid gap-1 text-sm dark:text-slate-300">Naam
                <input class="form-input" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required>
            </label>
            @error('name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm dark:text-slate-300">E-mail
                <input class="form-input" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
            </label>
            @error('email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm dark:text-slate-300">Onderwerp
                {{-- dropdown keeps subject values consistent in the admin dashboard --}}
                <select class="form-input" name="subject" required>
                    <option value="" disabled @selected(! old('subject'))>Kies een onderwerp…</option>
                    <option value="Vraag over training" @selected(old('subject') === 'Vraag over training')>Vraag over training</option>
                    <option value="Vraag over dagopvang" @selected(old('subject') === 'Vraag over dagopvang')>Vraag over dagopvang</option>
                    <option value="Vraag over een product" @selected(old('subject') === 'Vraag over een product')>Vraag over een product</option>
                    <option value="Overige vraag" @selected(old('subject') === 'Overige vraag')>Overige vraag</option>
                </select>
            </label>
            <p class="-mt-2 text-xs text-slate-500 dark:text-slate-400">Kies het onderwerp dat het dichtst bij je vraag past. Zo krijg je sneller een passend antwoord.</p>
            @error('subject') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm dark:text-slate-300">Bericht
                <textarea class="form-input" name="message" rows="6" placeholder="Beschrijf kort je situatie, je hond en waar je hulp bij zoekt." required>{{ old('message') }}</textarea>
            </label>
            @error('message') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
            <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600">Verstuur bericht</button>
        </form>
        </article>

        <aside class="card">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Directe tips</h2>
            <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-slate-600 dark:text-slate-400">
                <li>Omschrijf het gedrag van je hond kort en concreet.</li>
                <li>Vermeld leeftijd, ras en situatie thuis.</li>
                <li>Zet erbij wanneer je wilt starten.</li>
            </ul>
            <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">Zo kunnen we je sneller en gerichter helpen.</p>
        </aside>
    </section>
@endsection
