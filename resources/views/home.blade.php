@extends('layouts.app')

@section('content')
    @php
        $faqs = [
            [
                'question' => 'Waar begin ik als mijn hond nog jong is?',
                'answer' => 'Start meestal met training als je structuur, basiscommando\'s en zelfvertrouwen wilt opbouwen. Gebruik de shop als aanvulling voor thuis en plan dagopvang als je meer ritme of socialisatie zoekt.',
            ],
            [
                'question' => 'Kan ik eerst advies vragen voordat ik iets kies?',
                'answer' => 'Ja. Via contact kun je jouw situatie omschrijven. Dan krijg je een gericht voorstel dat past bij je hond, jouw doel en je planning.',
            ],
            [
                'question' => 'Is dit platform alleen voor puppy\'s?',
                'answer' => 'Nee. Puppy Power Academy helpt ook volwassen honden bij gedrag, focus, spanning en dagelijkse structuur.',
            ],
        ];
    @endphp

    {{-- quick intro block so users instantly know what this site is --}}
    <section class="fade-up hero-shell p-6 md:p-8">
        <p class="section-eyebrow mb-2">Jouw complete hondenplatform</p>
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
            <div>
                <h1 class="mb-3 text-3xl font-bold text-slate-900 dark:text-white md:text-5xl">Welkom bij Puppy Power Academy</h1>
                <p class="hero-subcopy max-w-2xl">
                    Shop, training en dagopvang op een plek. Voor nieuwe en ervaren hondeneigenaren.
                </p>
                <div class="mt-5 flex flex-wrap gap-2">
                    <a class="btn-primary" href="{{ route('shop.index') }}">Bekijk de shop</a>
                    <a class="inline-flex items-center justify-center rounded-lg bg-sky-700 px-4 py-2 text-sm font-medium text-white transition hover:bg-sky-600" href="{{ route('training.index') }}">Bekijk trainingen</a>
                    <a class="btn-dark" href="{{ route('daycare.index') }}">Plan dagopvang</a>
                    <a class="btn-secondary" href="{{ route('guide.index') }}">Lees adviesgids</a>
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-3 lg:grid-cols-1">
                <article class="stat-card-inverse">
                    <p class="text-sm text-slate-300">Actieve producten</p>
                    <p class="mt-1 text-3xl font-bold text-white">{{ $activeProducts ?? 0 }}</p>
                </article>
                <article class="stat-card-inverse">
                    <p class="text-sm text-slate-300">Actieve trainingen</p>
                    <p class="mt-1 text-3xl font-bold text-white">{{ $activeTrainings ?? 0 }}</p>
                </article>
                <article class="stat-card-inverse">
                    <p class="text-sm text-slate-300">Servicebelofte</p>
                    <p class="mt-1 text-lg font-bold text-white">Snelle reactie en praktische begeleiding</p>
                </article>
            </div>
        </div>
    </section>

    {{-- service cards like in the wireframe: each card has short text + action --}}
    <section class="mt-5 grid gap-4 md:grid-cols-3">
        <article class="fade-up fade-delay-1 card">
            <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Shop</h2>
            <p class="page-sub">Cursussen en DIY-pakketten die je direct kunt bestellen.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600" href="{{ route('shop.index') }}">Ga naar shop</a>
        </article>
        <article class="fade-up fade-delay-2 card">
            <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Training</h2>
            <p class="page-sub">Puppytraining, gedragstraining en hulp bij vuurwerkangst.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600" href="{{ route('training.index') }}">Ga naar training</a>
        </article>
        <article class="fade-up fade-delay-3 card">
            <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Dagopvang</h2>
            <p class="page-sub">Betrouwbare opvang met heldere planning en aanmeldingen.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600" href="{{ route('daycare.index') }}">Ga naar dagopvang</a>
        </article>
    </section>

    {{-- little extra info row so page feels complete --}}
    <section class="mt-4 grid gap-4 md:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-slate-100 p-5 dark:border-slate-700 dark:bg-slate-800">
            <h3 class="mb-2 text-lg font-semibold text-slate-900 dark:text-white">Voor wie?</h3>
            <p class="page-sub">Voor puppy-eigenaren en ervaren baasjes die structuur en hulp zoeken.</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-slate-100 p-5 dark:border-slate-700 dark:bg-slate-800">
            <h3 class="mb-2 text-lg font-semibold text-slate-900 dark:text-white">Hoe snel starten?</h3>
            <p class="page-sub">Je kunt direct een training kiezen of dagopvang aanvragen via de formulieren.</p>
        </article>
    </section>

    <section class="mt-4 grid gap-4 lg:grid-cols-[1.1fr_0.9fr]">
        <article class="card">
            <p class="section-eyebrow">Klaar om te kiezen?</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Welke route past het best bij jou en je hond?</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Shop</p>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Voor thuis oefenen met cursussen en praktische pakketten.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Training</p>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Voor begeleiding, gedragsvragen en gerichte opbouw.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Dagopvang</p>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Voor structuur, socialisatie en een veilige opvangdag.</p>
                </div>
            </div>
        </article>

        <article class="card">
            <p class="section-eyebrow">Vertrouwen</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Waarom dit als compleet platform werkt</h2>
            <div class="mt-4 grid gap-3">
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Eén duidelijke klantreis</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Van oriëntatie en intake tot begeleiding en vervolgstappen op één plek.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Praktische beslissingen</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Keuzehulp, filters, formulieren en snelle contactroutes maken de site bruikbaar.</p>
                </div>
            </div>
        </article>
    </section>

    <section class="mt-5 card rounded-2xl p-6 md:p-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Zo werkt het in 3 stappen</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-3">
            <article class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-800 dark:bg-emerald-950">
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Stap 1</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Kies je doel</h3>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Wil je trainen, dagopvang plannen of direct materiaal bestellen?</p>
            </article>
            <article class="rounded-xl border border-sky-200 bg-sky-50 p-4 dark:border-sky-800 dark:bg-sky-950">
                <p class="text-xs font-semibold uppercase tracking-wide text-sky-700 dark:text-sky-400">Stap 2</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Meld je online aan</h3>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Met het formulier regelen we intake, planning en eventuele vragen.</p>
            </article>
            <article class="rounded-xl border border-amber-200 bg-amber-50 p-4 dark:border-amber-800 dark:bg-amber-950">
                <p class="text-xs font-semibold uppercase tracking-wide text-amber-700 dark:text-amber-400">Stap 3</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">Start samen</h3>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Je krijgt begeleiding en praktische tips voor jou en je hond.</p>
            </article>
        </div>
    </section>

    <section class="mt-5 grid gap-4 lg:grid-cols-[1.3fr_0.7fr]">
        <article class="card">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">Waarom klanten kiezen voor ons</p>
            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-700/50">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Persoonlijk</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Advies dat past bij het gedrag en tempo van jouw hond.</p>
                </div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-700/50">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Praktisch</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Duidelijke oefeningen die je meteen thuis kunt toepassen.</p>
                </div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-700/50">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Veilig</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Rustige opbouw en aandacht voor welzijn en vertrouwen.</p>
                </div>
            </div>
        </article>

        <aside class="card">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Snel starten?</h2>
            <p class="mt-2 page-sub">Kies de route die nu het beste bij je past en zet vandaag de eerste stap.</p>
            <div class="mt-4 grid gap-2">
                <a href="{{ route('training.index') }}" class="btn-primary">Start met training</a>
                <a href="{{ route('daycare.index') }}" class="btn-secondary">Bekijk dagopvang</a>
            </div>
        </aside>
    </section>

    <section class="mt-5 grid gap-4 lg:grid-cols-3">
        <article class="card lg:col-span-2">
            <p class="section-eyebrow">Ervaring</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Wat mensen meestal nodig hebben voordat ze starten</h2>
            <div class="mt-4 grid gap-3 md:grid-cols-3">
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Rust in huis</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Meer grip op bijten, trekken, onrust of spanning.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Duidelijke opbouw</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Een realistische volgorde: intake, oefenen, bijsturen en volhouden.</p>
                </div>
                <div class="soft-panel">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Persoonlijk advies</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Gerichte hulp als je situatie niet in één standaardpakket past.</p>
                </div>
            </div>
        </article>

        <article class="card">
            <p class="section-eyebrow">Laatste check</p>
            <h2 class="mt-1 text-xl font-semibold text-slate-900 dark:text-white">Officieel compleet gevoel</h2>
            <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                <li>Volledige navigatie met duidelijke routes</li>
                <li>Responsieve layout met mobiel snelle acties</li>
                <li>Heldere formulieren en beheerpagina</li>
                <li>Donkere modus en consistente visuele stijl</li>
            </ul>
        </article>
    </section>

    <section class="mt-5">
        @include('partials.faq-accordion', [
            'title' => 'Veelgestelde vragen voor nieuwe bezoekers',
            'intro' => 'Nog twijfels? Deze vragen helpen bezoekers sneller de juiste route te kiezen.',
            'items' => $faqs,
        ])
    </section>

    <section class="cta-shell mt-5 px-6 py-8 md:px-8">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-emerald-300">Klaar voor de eerste stap?</p>
        <div class="mt-3 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-3xl font-bold">Bouw vandaag nog een plan voor jou en je hond.</h2>
                <p class="mt-2 max-w-2xl text-sm text-slate-300">Begin met training, plan dagopvang of vraag eerst persoonlijk advies. Alles is aanwezig om direct te starten.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('training.index') }}" class="btn-primary">Plan training</a>
                <a href="{{ route('contact.index') }}" class="btn-ghost-inverse">Vraag advies</a>
            </div>
        </div>
    </section>
@endsection
