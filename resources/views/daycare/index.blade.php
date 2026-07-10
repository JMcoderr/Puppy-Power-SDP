@extends('layouts.app')

@section('content')
    {{-- intro for daycare section --}}
    <section class="mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Dagopvang</h1>
        <p class="mt-1 text-slate-600">Veilige, professionele opvang met overzichtelijke planning en intake.</p>
    </section>

    @if (session('status'))
        <p class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-900">{{ session('status') }}</p>
    @endif

    @include('partials.form-error-summary')

    <section class="grid gap-4 lg:grid-cols-2">
        {{-- left column: schedule preview + why-daycare info block --}}
        <div class="grid gap-4">
            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900">Beschikbare planning</h2>
                <p class="mt-1 text-sm text-slate-500">Indicatief overzicht voor de komende dagen.</p>
                <div class="mt-3 overflow-x-auto">
                    <table class="w-full border-collapse text-sm">
                        <thead>
                            <tr>
                                <th class="border-b border-slate-200 bg-slate-50 px-3 py-2 text-left font-semibold">Datum</th>
                                <th class="border-b border-slate-200 bg-slate-50 px-3 py-2 text-left font-semibold">Beschikbaarheid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule as $slot)
                                <tr>
                                    <td class="border-b border-slate-100 px-3 py-2">{{ $slot['date'] }}</td>
                                    <td class="border-b border-slate-100 px-3 py-2 text-emerald-700">{{ $slot['available'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </article>

            {{-- extra info block to explain what daycare offers --}}
            <article class="rounded-xl border border-slate-200 bg-emerald-50 p-5">
                <h2 class="text-lg font-semibold text-slate-900">Waarom dagopvang bij ons?</h2>
                <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-slate-700">
                    <li>Kleine groepen van maximaal 6 honden</li>
                    <li>Begeleiding door gecertificeerde trainers</li>
                    <li>Dagelijks rapport via e-mail</li>
                    <li>Veilige buitenruimte met toezicht</li>
                </ul>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800">Meer vragen? Neem contact op</a>
            </article>
        </div>

        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Aanmelding dagopvang</h2>
            <form action="{{ route('daycare.store') }}" method="post" class="mt-4 grid gap-3">
                @csrf
                <label class="grid gap-1 text-sm">Naam eigenaar
                    <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="owner_name" value="{{ old('owner_name') }}" autocomplete="name" required>
                </label>
                @error('owner_name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                <label class="grid gap-1 text-sm">E-mail
                    <input class="rounded-md border border-slate-300 px-3 py-2" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                </label>
                @error('email') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                <label class="grid gap-1 text-sm">Naam hond
                    <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="dog_name" value="{{ old('dog_name') }}" required>
                </label>
                @error('dog_name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                <label class="grid gap-1 text-sm">Datum opvang
                    <input class="rounded-md border border-slate-300 px-3 py-2" type="date" name="drop_off_date" value="{{ old('drop_off_date') }}" required>
                </label>
                @error('drop_off_date') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                <label class="grid gap-1 text-sm">Dagdeel
                    <select class="rounded-md border border-slate-300 px-3 py-2" name="time_slot" required>
                        <option value="Ochtend" @selected(old('time_slot') === 'Ochtend')>Ochtend</option>
                        <option value="Middag" @selected(old('time_slot') === 'Middag')>Middag</option>
                        <option value="Hele dag" @selected(old('time_slot') === 'Hele dag')>Hele dag</option>
                    </select>
                </label>
                @error('time_slot') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                <label class="grid gap-1 text-sm">Notities
                    <textarea class="rounded-md border border-slate-300 px-3 py-2" name="notes" rows="4">{{ old('notes') }}</textarea>
                </label>
                <p class="-mt-2 text-xs text-slate-500">Vermeld bijzonderheden zoals medicatie of sociaal gedrag.</p>
                @error('notes') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Aanmelden</button>
            </form>
        </article>
    </section>
@endsection
