@extends('layouts.app')

@section('content')
    {{-- quick admin page for recent form entries --}}
    <section class="mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Beheer overzicht</h1>
        <p class="mt-1 text-slate-600">Hier zie je de nieuwste inschrijvingen, dagopvang-aanmeldingen en contactberichten.</p>
    </section>

    <section class="mb-4 grid gap-4 sm:grid-cols-3">
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Totaal training inschrijvingen</p>
            <p class="mt-1 text-2xl font-bold text-slate-900">{{ $totals['enrollments'] ?? 0 }}</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Totaal dagopvang aanmeldingen</p>
            <p class="mt-1 text-2xl font-bold text-slate-900">{{ $totals['daycare'] ?? 0 }}</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Totaal contactberichten</p>
            <p class="mt-1 text-2xl font-bold text-slate-900">{{ $totals['messages'] ?? 0 }}</p>
        </article>
    </section>

    <section class="mb-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-900">Zoeken en filteren</h2>
        <form method="get" action="{{ route('beheer.index') }}" class="mt-3 grid gap-3 md:grid-cols-5 md:items-end">
            <label class="grid gap-1 text-sm text-slate-700 md:col-span-2">
                Zoekterm
                <input
                    type="text"
                    name="q"
                    value="{{ $filters['q'] ?? '' }}"
                    placeholder="Naam, e-mail, hond of onderwerp"
                    class="rounded-md border border-slate-300 px-3 py-2"
                >
            </label>
            <label class="grid gap-1 text-sm text-slate-700">
                Vanaf
                <input type="date" name="from" value="{{ $filters['from'] ?? '' }}" class="rounded-md border border-slate-300 px-3 py-2">
            </label>
            <label class="grid gap-1 text-sm text-slate-700">
                Tot en met
                <input type="date" name="to" value="{{ $filters['to'] ?? '' }}" class="rounded-md border border-slate-300 px-3 py-2">
            </label>
            <label class="grid gap-1 text-sm text-slate-700">
                Sortering
                <select name="sort" class="rounded-md border border-slate-300 px-3 py-2">
                    <option value="newest" @selected(($filters['sort'] ?? 'newest') === 'newest')>Nieuwste eerst</option>
                    <option value="oldest" @selected(($filters['sort'] ?? '') === 'oldest')>Oudste eerst</option>
                    <option value="name_az" @selected(($filters['sort'] ?? '') === 'name_az')>Naam A-Z</option>
                    <option value="name_za" @selected(($filters['sort'] ?? '') === 'name_za')>Naam Z-A</option>
                </select>
            </label>
            <div class="flex gap-2 md:col-span-4">
                <button type="submit" class="inline-flex rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-900">Toepassen</button>
                <a href="{{ route('beheer.index') }}" class="inline-flex rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Reset</a>
                <a
                    href="{{ route('beheer.export', request()->only(['q', 'from', 'to', 'sort'])) }}"
                    class="inline-flex rounded-lg border border-emerald-300 bg-emerald-50 px-4 py-2 text-sm font-medium text-emerald-800 hover:bg-emerald-100"
                >
                    Exporteer CSV
                </a>
            </div>
        </form>

        @if (($filters['adjusted'] ?? false) === true)
            <p class="mt-3 rounded-md border border-amber-200 bg-amber-50 px-3 py-2 text-sm text-amber-900">
                Datumbereik is automatisch omgedraaid, omdat "vanaf" later was dan "tot en met".
            </p>
        @endif

        @if (! empty($filters['q']) || ! empty($filters['from']) || ! empty($filters['to']))
            <div class="mt-3 flex flex-wrap gap-2 text-xs">
                @if (! empty($filters['q']))
                    <span class="rounded-full border border-sky-200 bg-sky-50 px-3 py-1 font-medium text-sky-800">Zoek: {{ $filters['q'] }}</span>
                @endif
                @if (! empty($filters['from']))
                    <span class="rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 font-medium text-emerald-800">Vanaf: {{ $filters['from'] }}</span>
                @endif
                @if (! empty($filters['to']))
                    <span class="rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 font-medium text-emerald-800">Tot: {{ $filters['to'] }}</span>
                @endif
            </div>
        @endif
    </section>

    <section class="grid gap-4">
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Training inschrijvingen</h2>
            <p class="mt-1 text-sm text-slate-500">Resultaten: {{ $filteredCounts['enrollments'] ?? 0 }}</p>
            <div class="mt-3 grid gap-3 md:hidden">
                @forelse ($enrollments as $item)
                    <article class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm">
                        <p><strong>Eigenaar:</strong> {{ $item->owner_name }}</p>
                        <p><strong>Hond:</strong> {{ $item->dog_name }}</p>
                        <p><strong>Training:</strong> {{ $item->training?->title ?? '-' }}</p>
                        <p><strong>E-mail:</strong> {{ $item->email }}</p>
                    </article>
                @empty
                    <p class="text-sm text-slate-500">Nog geen inschrijvingen.</p>
                @endforelse
            </div>
            <div class="overflow-x-auto">
                <table class="mt-3 hidden w-full border-collapse text-sm md:table">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Eigenaar</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Hond</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Training</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enrollments as $item)
                            <tr>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->owner_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->dog_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->training?->title ?? '-' }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-2 py-3 text-slate-500">Nog geen inschrijvingen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $enrollments->onEachSide(1)->links() }}
            </div>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Dagopvang aanmeldingen</h2>
            <p class="mt-1 text-sm text-slate-500">Resultaten: {{ $filteredCounts['daycare'] ?? 0 }}</p>
            <div class="mt-3 grid gap-3 md:hidden">
                @forelse ($daycareRegistrations as $item)
                    <article class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm">
                        <p><strong>Eigenaar:</strong> {{ $item->owner_name }}</p>
                        <p><strong>Hond:</strong> {{ $item->dog_name }}</p>
                        <p><strong>Datum:</strong> {{ optional($item->drop_off_date)->format('d-m-Y') }}</p>
                        <p><strong>Dagdeel:</strong> {{ $item->time_slot }}</p>
                    </article>
                @empty
                    <p class="text-sm text-slate-500">Nog geen dagopvang aanmeldingen.</p>
                @endforelse
            </div>
            <div class="overflow-x-auto">
                <table class="mt-3 hidden w-full border-collapse text-sm md:table">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Eigenaar</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Hond</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Datum</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Dagdeel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daycareRegistrations as $item)
                            <tr>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->owner_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->dog_name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ optional($item->drop_off_date)->format('d-m-Y') }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->time_slot }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-2 py-3 text-slate-500">Nog geen dagopvang aanmeldingen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $daycareRegistrations->onEachSide(1)->links() }}
            </div>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Contactberichten</h2>
            <p class="mt-1 text-sm text-slate-500">Resultaten: {{ $filteredCounts['messages'] ?? 0 }}</p>
            <div class="mt-3 grid gap-3 md:hidden">
                @forelse ($contactMessages as $item)
                    <article class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm">
                        <p><strong>Naam:</strong> {{ $item->name }}</p>
                        <p><strong>Onderwerp:</strong> {{ $item->subject }}</p>
                        <p><strong>E-mail:</strong> {{ $item->email }}</p>
                    </article>
                @empty
                    <p class="text-sm text-slate-500">Nog geen contactberichten.</p>
                @endforelse
            </div>
            <div class="overflow-x-auto">
                <table class="mt-3 hidden w-full border-collapse text-sm md:table">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Naam</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">Onderwerp</th>
                            <th class="border-b border-slate-200 bg-slate-50 px-2 py-2 text-left font-semibold">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contactMessages as $item)
                            <tr>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->name }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->subject }}</td>
                                <td class="border-b border-slate-100 px-2 py-2">{{ $item->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-2 py-3 text-slate-500">Nog geen contactberichten.</td>
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
