@extends('layouts.app')

@section('content')
    {{-- page intro so user knows what this page is about --}}
    <section class="mb-4">
        <h1 class="page-heading">Shop</h1>
        <p class="page-sub mt-1">Ontdek cursussen en DIY-pakketten voor jou en je hond.</p>
    </section>

    <section class="mb-4 grid gap-4 sm:grid-cols-3">
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Actieve producten</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $summary['total'] ?? 0 }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Cursussen</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $summary['courses'] ?? 0 }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">DIY-pakketten</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $summary['kits'] ?? 0 }}</p>
        </article>
    </section>

    <section class="mb-4 card p-4">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Filter en sorteer</h2>
        <form method="get" action="{{ route('shop.index') }}" class="mt-3 grid gap-3 md:grid-cols-3 md:items-end">
            <label class="grid gap-1 text-sm dark:text-slate-300">
                Categorie
                <select name="category" class="form-input">
                    <option value="all" @selected(($filters['category'] ?? 'all') === 'all')>Alles</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" @selected(($filters['category'] ?? '') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
            </label>
            <label class="grid gap-1 text-sm dark:text-slate-300">
                Sorteer op
                <select name="sort" class="form-input">
                    <option value="name" @selected(($filters['sort'] ?? 'name') === 'name')>Naam A-Z</option>
                    <option value="price_low" @selected(($filters['sort'] ?? '') === 'price_low')>Prijs laag-hoog</option>
                    <option value="price_high" @selected(($filters['sort'] ?? '') === 'price_high')>Prijs hoog-laag</option>
                    <option value="category" @selected(($filters['sort'] ?? '') === 'category')>Categorie</option>
                </select>
            </label>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600">Toepassen</button>
                <a href="{{ route('shop.index') }}" class="inline-flex rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">Reset</a>
            </div>
        </form>
    </section>

    <section class="mb-4 grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
        <article class="card">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Keuzehulp</p>
            <h2 class="mt-1 text-xl font-semibold text-slate-900 dark:text-white">Wat past het best bij jouw situatie?</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-800 dark:bg-emerald-950">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Kies een cursus als je:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-600 dark:text-slate-400">
                        <li>stap voor stap begeleiding wilt</li>
                        <li>zelf thuis wilt oefenen</li>
                        <li>meer structuur zoekt in training</li>
                    </ul>
                </div>
                <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 dark:border-amber-800 dark:bg-amber-950">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Kies een DIY-pakket als je:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-600 dark:text-slate-400">
                        <li>praktisch bezig wilt zijn</li>
                        <li>je hond mentaal wilt uitdagen</li>
                        <li>een laagdrempelig startpunt zoekt</li>
                    </ul>
                </div>
            </div>
        </article>

        <article class="card">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Veelgekozen redenen</h2>
            <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                <li class="rounded-lg bg-slate-50 px-3 py-2 dark:bg-slate-700/50">Puppy bijt of luistert nog niet goed</li>
                <li class="rounded-lg bg-slate-50 px-3 py-2 dark:bg-slate-700/50">Hond raakt snel overprikkeld</li>
                <li class="rounded-lg bg-slate-50 px-3 py-2 dark:bg-slate-700/50">Je wilt thuis gerichter oefenen</li>
            </ul>
        </article>
    </section>

    <section class="grid gap-4 lg:grid-cols-[2fr_1fr]">
        <div class="grid gap-4 md:grid-cols-2">
        @forelse ($products as $product)
            <article class="card">
                {{-- colour the category badge based on its value --}}
                @php
                    $badgeClass = match($product->category) {
                        'Cursus'     => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300',
                        'DIY-pakket' => 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300',
                        default      => 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300',
                    };
                @endphp
                <p class="mb-2 inline-block rounded-full px-2 py-0.5 text-xs font-semibold {{ $badgeClass }}">{{ $product->category }}</p>
                <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">{{ $product->name }}</h2>
                <p class="page-sub">{{ $product->description }}</p>
                <p class="mt-4 text-lg font-bold text-slate-900 dark:text-white">&euro;&nbsp;{{ number_format($product->price, 2, ',', '.') }}</p>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Direct advies mogelijk via contactformulier.</p>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600">Vraag hierover</a>
            </article>
        @empty
            <article class="card">
                <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Nog geen producten</h2>
                <p class="page-sub">Er staan nu nog geen actieve producten in de shop.</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Kom later terug of stuur een vraag via contact.</p>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600">Naar contact</a>
            </article>
        @endforelse
        </div>

        <aside class="card lg:sticky lg:top-4 lg:h-fit">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Hulp bij kiezen</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Twijfel je tussen producten? Vertel ons je situatie en wij geven een passend advies.</p>
            <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-slate-600 dark:text-slate-400">
                <li>Snelle reactie via contact</li>
                <li>Advies voor puppy en volwassen hond</li>
                <li>Praktische tips op jouw niveau</li>
            </ul>
            <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-slate-800 px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 dark:bg-slate-600 dark:hover:bg-slate-500">Stel je vraag</a>

            <div class="mt-5 rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-700/50">
                <p class="text-sm font-semibold text-slate-900 dark:text-white">Nog niet zeker?</p>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Stuur een korte omschrijving van je hond en je doel. Dan helpen we je kiezen.</p>
            </div>
        </aside>
    </section>
@endsection
