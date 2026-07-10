@extends('layouts.app')

@section('content')
    {{-- quick admin page for recent form entries --}}
    <section class="page-head mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Beheer overzicht</h1>
        <p class="mt-1 text-slate-600">Hier zie je de nieuwste inschrijvingen, dagopvang-aanmeldingen en contactberichten.</p>
    </section>

    <section class="cards-grid beheer-grid grid gap-4">
        <article class="card rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Training inschrijvingen</h2>
            <div class="table-wrap">
                <table class="simple-table mt-3 w-full border-collapse text-sm">
                    <thead>
                        <tr>
                            <th>Eigenaar</th>
                            <th>Hond</th>
                            <th>Training</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enrollments as $item)
                            <tr>
                                <td>{{ $item->owner_name }}</td>
                                <td>{{ $item->dog_name }}</td>
                                <td>{{ $item->training?->title ?? '-' }}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nog geen inschrijvingen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>

        <article class="card rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Dagopvang aanmeldingen</h2>
            <div class="table-wrap">
                <table class="simple-table mt-3 w-full border-collapse text-sm">
                    <thead>
                        <tr>
                            <th>Eigenaar</th>
                            <th>Hond</th>
                            <th>Datum</th>
                            <th>Dagdeel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daycareRegistrations as $item)
                            <tr>
                                <td>{{ $item->owner_name }}</td>
                                <td>{{ $item->dog_name }}</td>
                                <td>{{ optional($item->drop_off_date)->format('d-m-Y') }}</td>
                                <td>{{ $item->time_slot }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nog geen dagopvang aanmeldingen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>

        <article class="card rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Contactberichten</h2>
            <div class="table-wrap">
                <table class="simple-table mt-3 w-full border-collapse text-sm">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Onderwerp</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contactMessages as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Nog geen contactberichten.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </article>
    </section>
@endsection
