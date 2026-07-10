@extends('layouts.app')

@section('content')
    @php
        $faqs = [
            [
                'question' => 'Welke training past bij een jonge of onzekere hond?',
                'answer' => 'Begin meestal met een basis- of puppyroute. Die bouwt rust, focus en vertrouwen op voordat je moeilijkere gedragsthema\'s aanpakt.',
            ],
            [
                'question' => 'Wat gebeurt er na mijn inschrijving?',
                'answer' => 'Na inschrijving nemen we je aanvraag mee in de planning. Daarna volgt een bevestiging en kun je gericht voorbereiden op de startdatum.',
            ],
            [
                'question' => 'Kan ik ook advies krijgen als ik twijfel?',
                'answer' => 'Ja. Gebruik het contactformulier als je wilt sparren over gedrag, leeftijd, energie of de beste eerste stap.',
            ],
        ];
    @endphp

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
        <article class="card p-4 sm:col-span-3">
            <p class="text-sm text-slate-500 dark:text-slate-400">Gedragstrainingen in overzicht</p>
            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $summary['behaviour'] ?? 0 }}</p>
        </article>
    </section>

    <section class="mb-4 card p-4">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Filter en sorteer</h2>
        <form method="get" action="{{ route('training.index') }}" class="mt-3 grid gap-3 md:grid-cols-4 md:items-end">
            <label class="grid gap-1 text-sm dark:text-slate-300">
                Beschikbaarheid
                <select name="availability" class="form-input">
                    <option value="all" @selected(($filters['availability'] ?? 'all') === 'all')>Alles</option>
                    <option value="open" @selected(($filters['availability'] ?? '') === 'open')>Nog plek</option>
                    <option value="full" @selected(($filters['availability'] ?? '') === 'full')>Vol</option>
                </select>
            </label>
            <label class="grid gap-1 text-sm dark:text-slate-300">
                Doel
                <select name="focus" class="form-input">
                    <option value="all" @selected(($filters['focus'] ?? 'all') === 'all')>Alle doelen</option>
                    <option value="basis" @selected(($filters['focus'] ?? '') === 'basis')>Basis en puppy</option>
                    <option value="gedrag" @selected(($filters['focus'] ?? '') === 'gedrag')>Gedrag</option>
                    <option value="zelfvertrouwen" @selected(($filters['focus'] ?? '') === 'zelfvertrouwen')>Zelfvertrouwen</option>
                    <option value="focus" @selected(($filters['focus'] ?? '') === 'focus')>Focus en puberfase</option>
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

    <section class="mb-4 grid gap-4 lg:grid-cols-[1.05fr_0.95fr]">
        <article class="card">
            <p class="section-eyebrow">Aanpak</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Wat je kunt verwachten van onze training</h2>
            <div class="mt-4 grid gap-3 md:grid-cols-3">
                <div class="timeline-step">
                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Stap 1</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900 dark:text-white">Kies een passend doel</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Basis, gedrag, focus of zelfvertrouwen. Zo start je meteen in de juiste richting.</p>
                </div>
                <div class="timeline-step">
                    <p class="text-xs font-semibold uppercase tracking-wide text-sky-700 dark:text-sky-400">Stap 2</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900 dark:text-white">Meld je online aan</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Vul eigenaar, hond en eventuele notities in zodat de intake goed begint.</p>
                </div>
                <div class="timeline-step">
                    <p class="text-xs font-semibold uppercase tracking-wide text-amber-700 dark:text-amber-400">Stap 3</p>
                    <p class="mt-2 text-sm font-semibold text-slate-900 dark:text-white">Werk met duidelijke opbouw</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">We bouwen vaardigheden stap voor stap op en houden het praktisch.</p>
                </div>
            </div>
        </article>

        <article class="card">
            <p class="section-eyebrow">Keuzehulp</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Twijfel je nog tussen trainingen?</h2>
            <div class="mt-4 grid gap-3">
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Puppy of basis</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Goed als je wilt werken aan luisteren, ritme en een fijne start samen.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Gedrag of spanning</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Handig bij uitvallen, onrust, vuurwerkangst of moeite met prikkels.</p>
                </div>
                <a href="{{ route('contact.index') }}" class="btn-secondary w-fit">Vraag eerst persoonlijk advies</a>
            </div>
        </article>
    </section>

    <section class="grid gap-4 lg:grid-cols-2">
        @forelse ($trainings as $training)
            <article class="card">
                <div class="mb-2 flex flex-wrap gap-2">
                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700 dark:bg-slate-700 dark:text-slate-200">{{ $training->level }}</span>
                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">{{ ucfirst($training->focus) }}</span>
                </div>
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

                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($training->highlights as $highlight)
                        <span class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700 dark:border-slate-700 dark:bg-slate-700/50 dark:text-slate-200">{{ $highlight }}</span>
                    @endforeach
                </div>

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

    <section class="mt-5 grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
        <article class="card">
            <p class="section-eyebrow">Extra voorbereiding</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Zo bereid je je goed voor op een training</h2>
            <div class="mt-4 grid gap-3 md:grid-cols-3">
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Observeer gedrag</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Noteer wanneer spanning, trekken of afleiding het sterkst opvalt.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Kies een realistisch tempo</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Een rustige opbouw werkt vaak beter dan te veel tegelijk willen aanpakken.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Gebruik notities slim</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Vertel in je inschrijving waar je hond op vastloopt, zodat de intake sterker start.</p>
                </div>
            </div>
        </article>

        <article class="card">
            <p class="section-eyebrow">Na inschrijving</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Wat je daarna kunt verwachten</h2>
            <ul class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-400">
                <li class="soft-panel">Je aanvraag wordt gekoppeld aan de juiste training en planning.</li>
                <li class="soft-panel">Je krijgt duidelijkheid over startmoment, aanpak en vervolgstap.</li>
                <li class="soft-panel">Ingelogde gebruikers kunnen daarna verder in de trainingscontent.</li>
            </ul>
        </article>
    </section>

    <section class="mt-5">
        @include('partials.faq-accordion', [
            'title' => 'Training veelgestelde vragen',
            'intro' => 'Deze extra uitleg helpt bezoekers sneller en zekerder inschrijven.',
            'items' => $faqs,
            'accent' => 'sky',
        ])
    </section>
@endsection
