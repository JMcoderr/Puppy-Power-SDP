@extends('layouts.app')

@section('content')
    {{-- quick heading and context --}}
    <section class="mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Training</h1>
        <p class="mt-1 text-slate-600">Schrijf je in voor puppytraining, vuurwerkangst of gedragstraining.</p>
    </section>

    @if (session('status'))
        <p class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-900">{{ session('status') }}</p>
    @endif

    <section class="grid gap-4 lg:grid-cols-2">
        @forelse ($trainings as $training)
            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900">{{ $training->title }}</h2>
                <p class="mt-2 text-slate-600">{{ $training->summary }}</p>
                <p class="mt-3 text-sm"><strong>Start:</strong> {{ optional($training->starts_on)->format('d-m-Y') }}</p>
                <p class="text-sm"><strong>Plekken:</strong> {{ $training->capacity }}</p>

                <form action="{{ route('training.enroll') }}" method="post" class="mt-4 grid gap-3">
                    @csrf
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <label class="grid gap-1 text-sm">Naam eigenaar
                        <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="owner_name" value="{{ old('owner_name') }}" required>
                    </label>
                    @error('owner_name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm">E-mail
                        <input class="rounded-md border border-slate-300 px-3 py-2" type="email" name="email" value="{{ old('email') }}" required>
                    </label>
                    @error('email') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm">Naam hond
                        <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="dog_name" value="{{ old('dog_name') }}" required>
                    </label>
                    @error('dog_name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm">Telefoon
                        <input class="rounded-md border border-slate-300 px-3 py-2" type="text" name="phone" value="{{ old('phone') }}">
                    </label>
                    @error('phone') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm">Notities
                        <textarea class="rounded-md border border-slate-300 px-3 py-2" name="notes" rows="3">{{ old('notes') }}</textarea>
                    </label>
                    @error('notes') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
                    <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Inschrijven</button>
                </form>
            </article>
        @empty
            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900">Geen actieve trainingen</h2>
                <p class="mt-2 text-slate-600">Op dit moment zijn er geen trainingen beschikbaar.</p>
            </article>
        @endforelse
    </section>
@endsection
