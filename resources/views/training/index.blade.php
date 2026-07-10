@extends('layouts.app')

@section('content')
    {{-- quick heading and context --}}
    <section class="mb-4">
        <h1 class="page-heading">Training</h1>
        <p class="page-sub mt-1">Schrijf je in voor puppytraining, vuurwerkangst of gedragstraining.</p>
    </section>

    @if (session('status'))
        <p class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-900 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">{{ session('status') }}</p>
    @endif

    @include('partials.form-error-summary')

    <section class="grid gap-4 lg:grid-cols-2">
        @forelse ($trainings as $training)
            <article class="card">
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $training->title }}</h2>
                <p class="mt-2 page-sub">{{ $training->summary }}</p>
                <p class="mt-3 text-sm dark:text-slate-300"><strong>Start:</strong> {{ optional($training->starts_on)->format('d-m-Y') }}</p>
                {{-- calculate remaining spots from capacity minus current enrollment count --}}
                @php $spots = max(0, $training->capacity - ($training->enrollments_count ?? 0)); @endphp
                <p class="text-sm dark:text-slate-300">
                    <strong>Beschikbare plekken:</strong>
                    @if ($spots > 0)
                        <span class="text-emerald-700 dark:text-emerald-400">{{ $spots }} van {{ $training->capacity }}</span>
                    @else
                        <span class="font-semibold text-red-600 dark:text-red-400">Vol</span>
                    @endif
                </p>

                <form action="{{ route('training.enroll') }}" method="post" class="mt-4 grid gap-3">
                    @csrf
                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                    <label class="grid gap-1 text-sm dark:text-slate-300">Naam eigenaar
                        <input class="form-input" type="text" name="owner_name" value="{{ old('owner_name') }}" autocomplete="name" required>
                    </label>
                    <p class="-mt-2 text-xs text-slate-500 dark:text-slate-400">Gebruik je volledige naam voor de intake.</p>
                    @error('owner_name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm dark:text-slate-300">E-mail
                        <input class="form-input" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                    </label>
                    @error('email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm dark:text-slate-300">Naam hond
                        <input class="form-input" type="text" name="dog_name" value="{{ old('dog_name') }}" required>
                    </label>
                    @error('dog_name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm dark:text-slate-300">Telefoon
                        <input class="form-input" type="text" name="phone" value="{{ old('phone') }}" inputmode="tel" autocomplete="tel">
                    </label>
                    @error('phone') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    <label class="grid gap-1 text-sm dark:text-slate-300">Notities
                        <textarea class="form-input" name="notes" rows="3">{{ old('notes') }}</textarea>
                    </label>
                    @error('notes') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600">Inschrijven</button>
                </form>
            </article>
        @empty
            <article class="card">
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Geen actieve trainingen</h2>
                <p class="mt-2 page-sub">Op dit moment zijn er geen trainingen beschikbaar.</p>
            </article>
        @endforelse
    </section>
@endsection
