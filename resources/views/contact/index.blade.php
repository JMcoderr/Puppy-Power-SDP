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

    <section class="max-w-3xl rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">We reageren meestal binnen 1 werkdag.</p>
        <form action="{{ route('contact.store') }}" method="post" class="mt-4 grid gap-3">
            @csrf
            <label class="grid gap-1 text-sm">Naam
                <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="name" value="{{ old('name') }}" required>
            </label>
            @error('name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">E-mail
                <input class="rounded-md border border-slate-300 px-3 py-2" type="email" name="email" value="{{ old('email') }}" required>
            </label>
            @error('email') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">Onderwerp
                <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="subject" value="{{ old('subject') }}" required>
            </label>
            @error('subject') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">Bericht
                <textarea class="rounded-md border border-slate-300 px-3 py-2" name="message" rows="6" required>{{ old('message') }}</textarea>
            </label>
            @error('message') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
            <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Verstuur bericht</button>
        </form>
    </section>
@endsection
