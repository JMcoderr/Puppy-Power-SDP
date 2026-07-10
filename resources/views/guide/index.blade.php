@extends('layouts.app')

@section('content')
    <section class="hero-shell p-6 md:p-8">
        <p class="section-eyebrow">Adviesgids</p>
        <div class="mt-3 grid gap-6 lg:grid-cols-[1.15fr_0.85fr] lg:items-end">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white md:text-5xl">Jouw startpunt voor een slim plan met je hond</h1>
                <p class="hero-subcopy mt-3 max-w-2xl">Deze gids helpt je kiezen tussen shop, training en dagopvang. Handig als je nog twijfelt, eerst overzicht wilt of gewoon een duidelijker plan nodig hebt.</p>
                <div class="mt-5 flex flex-wrap gap-2">
                    <a href="{{ route('training.index') }}" class="btn-primary">Bekijk trainingen</a>
                    <a href="{{ route('shop.index') }}" class="btn-secondary">Bekijk shop</a>
                    <a href="{{ route('contact.index') }}" class="btn-dark">Vraag advies</a>
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-3 lg:grid-cols-1">
                <article class="stat-card-inverse">
                    <p class="text-sm text-slate-300">Handig voor</p>
                    <p class="mt-1 text-lg font-bold text-white">Nieuwe bezoekers</p>
                </article>
                <article class="stat-card-inverse">
                    <p class="text-sm text-slate-300">Doel</p>
                    <p class="mt-1 text-lg font-bold text-white">Sneller de juiste route kiezen</p>
                </article>
                <article class="stat-card-inverse">
                    <p class="text-sm text-slate-300">Uitkomst</p>
                    <p class="mt-1 text-lg font-bold text-white">Meer rust, structuur en duidelijkheid</p>
                </article>
            </div>
        </div>
    </section>

    <section class="mt-5 grid gap-4 lg:grid-cols-3">
        <article class="card">
            <p class="section-eyebrow">Route 1</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Shop</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Handig als je thuis zelf wilt oefenen met cursussen, stappenplannen en verrijkingspakketten.</p>
            <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                <li>Goed voor een rustige start</li>
                <li>Fijn als je zelfstandig wilt werken</li>
                <li>Past goed naast training</li>
            </ul>
        </article>
        <article class="card">
            <p class="section-eyebrow">Route 2</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Training</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Past als je gerichte begeleiding nodig hebt bij gedrag, focus, spanning of het opbouwen van basisvaardigheden.</p>
            <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                <li>Persoonlijker en gerichter</li>
                <li>Goed bij echte hulpvragen</li>
                <li>Extra sterk in combinatie met ledencontent</li>
            </ul>
        </article>
        <article class="card">
            <p class="section-eyebrow">Route 3</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Dagopvang</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Slim als je hond baat heeft bij structuur, begeleiding en een veilige dagindeling buiten huis.</p>
            <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                <li>Helpt ritme en sociale ondersteuning</li>
                <li>Fijn voor werk- of drukke dagen</li>
                <li>Geeft extra observatiemomenten</li>
            </ul>
        </article>
    </section>

    <section class="mt-5 card">
        <p class="section-eyebrow">In 3 stappen</p>
        <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Zo gebruik je deze gids het best</h2>
        <div class="mt-4 grid gap-3 md:grid-cols-3">
            @foreach ($steps as $step)
                <article class="timeline-step">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $step['title'] }}</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ $step['copy'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-5 grid gap-4 lg:grid-cols-[1.15fr_0.85fr]">
        <article class="card">
            <p class="section-eyebrow">Veelvoorkomende situaties</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Waar herken jij je het meest in?</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                @foreach ($situations as $item)
                    <div class="soft-panel">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $item['title'] }}</p>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ $item['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>

        <aside class="card">
            <p class="section-eyebrow">Snelle checklist</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">Als je vandaag nog wilt starten</h2>
            <ul class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-400">
                <li class="soft-panel">Beschrijf in 1 zin wat nu het lastigste moment van de dag is.</li>
                <li class="soft-panel">Kies eerst 1 hoofddoel: rust, focus, basis of begeleiding.</li>
                <li class="soft-panel">Beslis of je thuis zelfstandig wilt starten of liever direct begeleiding wilt.</li>
                <li class="soft-panel">Gebruik daarna shop, training of contact als je vervolgstap.</li>
            </ul>
        </aside>
    </section>

    <section class="mt-5">
        @include('partials.faq-accordion', [
            'title' => 'Veelgestelde vragen bij het kiezen van een route',
            'intro' => 'Deze vragen helpen nieuwe bezoekers sneller en zekerder beslissen.',
            'items' => $faqs,
        ])
    </section>

    <section class="cta-shell mt-5 px-6 py-8 md:px-8">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-emerald-300">Laatste stap</p>
        <div class="mt-3 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-3xl font-bold">Gebruik de gids en kies daarna meteen je vervolgstap.</h2>
                <p class="mt-2 max-w-2xl text-sm text-slate-300">Zo voelt de site niet alleen mooi, maar ook echt compleet en bruikbaar: kijken, kiezen en direct doorpakken.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('training.index') }}" class="btn-primary">Start met training</a>
                <a href="{{ route('contact.index') }}" class="btn-ghost-inverse">Vraag persoonlijk advies</a>
            </div>
        </div>
    </section>
@endsection