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

    <section class="mb-4 grid gap-4 sm:grid-cols-3">
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Actieve trainingen</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $summary['active'] ?? 0 }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Open inschrijvingen</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $summary['open'] ?? 0 }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Eerstvolgende start</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $summary['nextStart'] ?? '-' }}</p>
        </article>
    </section>

    <section class="mb-4 card p-4">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Filter en sorteer</h2>
        <form method="get" action="{{ route('training.index') }}" class="mt-3 grid gap-3 md:grid-cols-3 md:items-end">
            <label class="grid gap-1 text-sm dark:text-slate-300">
                Beschikbaarheid
                <select name="availability" class="form-input">
                    <option value="all" @selected(($filters['availability'] ?? 'all') === 'all')>Alles</option>
                    <option value="open" @selected(($filters['availability'] ?? '') === 'open')>Nog plek</option>
                    <option value="full" @selected(($filters['availability'] ?? '') === 'full')>Vol</option>
                </select>
            </label>
            <label class="grid gap-1 text-sm dark:text-slate-300">
                Sorteer op
                <select name="sort" class="form-input">
                    <option value="start_date" @selected(($filters['sort'] ?? 'start_date') === 'start_date')>Startdatum</option>
                    <option value="spots" @selected(($filters['sort'] ?? '') === 'spots')>Meeste plekken</option>
                    <option value="capacity" @selected(($filters['sort'] ?? '') === 'capacity')>Capaciteit</option>
                    <option value="name" @selected(($filters['sort'] ?? '') === 'name')>Naam A-Z</option>
                </select>
            </label>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600">Toepassen</button>
                <a href="{{ route('training.index') }}" class="inline-flex rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">Reset</a>
            </div>
        </form>
    </section>

    <section class="grid gap-4 lg:grid-cols-2">
        @forelse ($trainings as $training)
            <article class="card">
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $training->title }}</h2>
                <p class="mt-2 page-sub">{{ $training->summary }}</p>
                <p class="mt-3 text-sm dark:text-slate-300"><strong>Start:</strong> {{ optional($training->starts_on)->format('d-m-Y') }}</p>
                {{-- calculate remaining spots from capacity minus current enrollment count --}}
                @php $spots = $training->remaining_spots ?? max(0, $training->capacity - ($training->enrollments_count ?? 0)); @endphp
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
