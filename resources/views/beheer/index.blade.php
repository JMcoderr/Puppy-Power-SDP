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

    <section class="grid gap-4">
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Training inschrijvingen</h2>
            <div class="overflow-x-auto">
                <table class="mt-3 w-full border-collapse text-sm">
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
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Dagopvang aanmeldingen</h2>
            <div class="overflow-x-auto">
                <table class="mt-3 w-full border-collapse text-sm">
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
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Contactberichten</h2>
            <div class="overflow-x-auto">
                <table class="mt-3 w-full border-collapse text-sm">
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
        </article>
    </section>
@endsection
