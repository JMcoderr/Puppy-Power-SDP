@extends('layouts.app')

@section('content')
    {{-- quick admin page for recent form entries --}}
    <section class="mb-4">
        <h1 class="page-heading">Beheer overzicht</h1>
        <p class="page-sub mt-1">Hier zie je de nieuwste inschrijvingen, dagopvang-aanmeldingen en contactberichten.</p>
    </section>

    <section class="mb-4 grid gap-4 sm:grid-cols-3">
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Totaal training inschrijvingen</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $totals['enrollments'] ?? 0 }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Totaal dagopvang aanmeldingen</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $totals['daycare'] ?? 0 }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Totaal contactberichten</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $totals['messages'] ?? 0 }}</p>
        </article>
    </section>

    <section class="mb-4 grid gap-4 lg:grid-cols-[1fr_1fr_1.1fr]">
        <article class="card">
            <p class="section-eyebrow">Operationele inzichten</p>
            <h2 class="mt-1 text-xl font-semibold text-slate-900 dark:text-white">Live status</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                <div class="soft-panel">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Nieuwe items vandaag</p>
                    <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $insights['today'] ?? 0 }}</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Laatste activiteit</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $insights['latestActivity'] ? \Illuminate\Support\Carbon::parse($insights['latestActivity'])->format('d-m-Y H:i') : 'Nog geen activiteit' }}</p>
                </div>
            </div>
        </article>

        <article class="card">
            <p class="section-eyebrow">Aandachtspunt</p>
            <h2 class="mt-1 text-xl font-semibold text-slate-900 dark:text-white">Meest voorkomende contactvraag</h2>
            <div class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-800 dark:bg-emerald-950">
                <p class="text-sm text-emerald-800 dark:text-emerald-300">Onderwerp met meeste signalen</p>
                <p class="mt-2 text-xl font-bold text-slate-900 dark:text-white">{{ $insights['attentionArea'] }}</p>
            </div>
            <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">Gebruik dit om je opvolging en planning extra gericht te organiseren.</p>
        </article>

        <article class="card">
            <p class="section-eyebrow">Verdeling</p>
            <h2 class="mt-1 text-xl font-semibold text-slate-900 dark:text-white">Korte managementsamenvatting</h2>
            <div class="mt-4 grid gap-3">
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Top trainingen</p>
                    <ul class="mt-2 space-y-1 text-sm text-slate-600 dark:text-slate-400">
                        @forelse ($breakdowns['topTrainings'] as $name => $count)
                            <li>{{ $name }}: <strong class="text-slate-900 dark:text-white">{{ $count }}</strong></li>
                        @empty
                            <li>Nog geen trainingsdata beschikbaar.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </article>
    </section>

    <section class="card mb-4 p-4">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Zoeken en filteren</h2>
        <form method="get" action="{{ route('beheer.index') }}" class="mt-3 grid gap-3 md:grid-cols-5 md:items-end">
            <label class="grid gap-1 text-sm text-slate-700 dark:text-slate-300 md:col-span-2">
                Zoekterm
                <input
                    type="text"
                    name="q"
                    value="{{ $filters['q'] ?? '' }}"
                    placeholder="Naam, e-mail, hond of onderwerp"
                    class="form-input"
                >
            </label>
            <label class="grid gap-1 text-sm text-slate-700 dark:text-slate-300">
                Vanaf
                <input type="date" name="from" value="{{ $filters['from'] ?? '' }}" class="form-input">
            </label>
            <label class="grid gap-1 text-sm text-slate-700 dark:text-slate-300">
                Tot en met
                <input type="date" name="to" value="{{ $filters['to'] ?? '' }}" class="form-input">
            </label>
            <label class="grid gap-1 text-sm text-slate-700 dark:text-slate-300">
                Sortering
                <select name="sort" class="form-input">
                    <option value="newest" @selected(($filters['sort'] ?? 'newest') === 'newest')>Nieuwste eerst</option>
                    <option value="oldest" @selected(($filters['sort'] ?? '') === 'oldest')>Oudste eerst</option>
                    <option value="name_az" @selected(($filters['sort'] ?? '') === 'name_az')>Naam A-Z</option>
                    <option value="name_za" @selected(($filters['sort'] ?? '') === 'name_za')>Naam Z-A</option>
                </select>
            </label>
            <div class="flex gap-2 md:col-span-4">
                <button type="submit" class="inline-flex rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600">Toepassen</button>
                <a href="{{ route('beheer.index') }}" class="inline-flex rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">Reset</a>
                <a
                    href="{{ route('beheer.export', request()->only(['q', 'from', 'to', 'sort'])) }}"
                    class="inline-flex rounded-lg border border-emerald-300 bg-emerald-50 px-4 py-2 text-sm font-medium text-emerald-800 hover:bg-emerald-100 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 dark:hover:bg-emerald-900"
                >
                    Exporteer CSV
                </a>
            </div>
        </form>

        @if (($filters['adjusted'] ?? false) === true)
            <p class="mt-3 rounded-md border border-amber-200 bg-amber-50 px-3 py-2 text-sm text-amber-900 dark:border-amber-800 dark:bg-amber-950 dark:text-amber-300">
                Datumbereik is automatisch omgedraaid, omdat "vanaf" later was dan "tot en met".
            </p>
        @endif

        @if (! empty($filters['q']) || ! empty($filters['from']) || ! empty($filters['to']))
            <div class="mt-3 flex flex-wrap gap-2 text-xs">
                @if (! empty($filters['q']))
                    <span class="rounded-full border border-sky-200 bg-sky-50 px-3 py-1 font-medium text-sky-800 dark:border-sky-800 dark:bg-sky-950 dark:text-sky-300">Zoek: {{ $filters['q'] }}</span>
                @endif
                @if (! empty($filters['from']))
                    <span class="rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 font-medium text-emerald-800 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Vanaf: {{ $filters['from'] }}</span>
                @endif
                @if (! empty($filters['to']))
                    <span class="rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 font-medium text-emerald-800 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Tot: {{ $filters['to'] }}</span>
                @endif
            </div>
        @endif
    </section>

    <section class="mb-4 grid gap-4 lg:grid-cols-2">
        <article class="card">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Contactverdeling</h2>
            <div class="mt-4 grid gap-3">
                @forelse ($breakdowns['subjects'] as $subject => $count)
                    <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 dark:border-slate-700 dark:bg-slate-700/40">
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ $subject }}</span>
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300">{{ $count }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 dark:text-slate-400">Nog geen contactberichten beschikbaar.</p>
                @endforelse
            </div>
        </article>

        <article class="card">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Dagopvang verdeling</h2>
            <div class="mt-4 grid gap-3">
                @forelse ($breakdowns['daycareSlots'] as $slot => $count)
                    <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 dark:border-slate-700 dark:bg-slate-700/40">
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ $slot }}</span>
                        <span class="rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-800 dark:bg-sky-900 dark:text-sky-300">{{ $count }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 dark:text-slate-400">Nog geen dagopvang-aanmeldingen beschikbaar.</p>
                @endforelse
            </div>
        </article>
    </section>

    <section class="grid gap-4">
        <article class="card">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Training inschrijvingen</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Resultaten: {{ $filteredCounts['enrollments'] ?? 0 }}</p>
            <div class="mt-3 grid gap-3 md:hidden">
                @forelse ($enrollments as $item)
                    <article class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-700/50 dark:text-slate-300">
                        <p><strong>Eigenaar:</strong> {{ $item->owner_name }}</p>
                        <p><strong>Hond:</strong> {{ $item->dog_name }}</p>
                        <p><strong>Training:</strong> {{ $item->training?->title ?? '-' }}</p>
                        <p><strong>E-mail:</strong> {{ $item->email }}</p>
                    </article>
                @empty
                    <p class="text-sm text-slate-500 dark:text-slate-400">Nog geen inschrijvingen.</p>
                @endforelse
            </div>
            <div class="overflow-x-auto rounded-lg border border-slate-200 dark:border-slate-700">
                <table class="mt-3 hidden w-full border-collapse text-sm md:table">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Eigenaar</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Hond</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Training</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enrollments as $item)
                            <tr>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->owner_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->dog_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->training?->title ?? '-' }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-2 py-3 text-slate-500 dark:text-slate-400">Nog geen inschrijvingen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $enrollments->onEachSide(1)->links() }}
            </div>
        </article>

        <article class="card">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Dagopvang aanmeldingen</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Resultaten: {{ $filteredCounts['daycare'] ?? 0 }}</p>
            <div class="mt-3 grid gap-3 md:hidden">
                @forelse ($daycareRegistrations as $item)
                    <article class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-700/50 dark:text-slate-300">
                        <p><strong>Eigenaar:</strong> {{ $item->owner_name }}</p>
                        <p><strong>Hond:</strong> {{ $item->dog_name }}</p>
                        <p><strong>Datum:</strong> {{ optional($item->drop_off_date)->format('d-m-Y') }}</p>
                        <p><strong>Dagdeel:</strong> {{ $item->time_slot }}</p>
                    </article>
                @empty
                    <p class="text-sm text-slate-500 dark:text-slate-400">Nog geen dagopvang aanmeldingen.</p>
                @endforelse
            </div>
            <div class="overflow-x-auto rounded-lg border border-slate-200 dark:border-slate-700">
                <table class="mt-3 hidden w-full border-collapse text-sm md:table">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Eigenaar</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Hond</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Datum</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Dagdeel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daycareRegistrations as $item)
                            <tr>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->owner_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->dog_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ optional($item->drop_off_date)->format('d-m-Y') }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->time_slot }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-2 py-3 text-slate-500 dark:text-slate-400">Nog geen dagopvang aanmeldingen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $daycareRegistrations->onEachSide(1)->links() }}
            </div>
        </article>

        <article class="card">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Contactberichten</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Resultaten: {{ $filteredCounts['messages'] ?? 0 }}</p>
            <div class="mt-3 grid gap-3 md:hidden">
                @forelse ($contactMessages as $item)
                    <article class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-700/50 dark:text-slate-300">
                        <p><strong>Naam:</strong> {{ $item->name }}</p>
                        <p><strong>Onderwerp:</strong> {{ $item->subject }}</p>
                        <p><strong>E-mail:</strong> {{ $item->email }}</p>
                    </article>
                @empty
                    <p class="text-sm text-slate-500 dark:text-slate-400">Nog geen contactberichten.</p>
                @endforelse
            </div>
            <div class="overflow-x-auto rounded-lg border border-slate-200 dark:border-slate-700">
                <table class="mt-3 hidden w-full border-collapse text-sm md:table">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Naam</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">Onderwerp</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contactMessages as $item)
                            <tr>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->subject }}</td>
                                <td class="border-b border-slate-100 px-2 py-2 dark:border-slate-700 dark:text-slate-300">{{ $item->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-2 py-3 text-slate-500 dark:text-slate-400">Nog geen contactberichten.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $contactMessages->onEachSide(1)->links() }}
            </div>
        </article>
    </section>
@endsection
