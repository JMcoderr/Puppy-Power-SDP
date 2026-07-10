@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <h1 class="page-heading">Mijn account</h1>
        <p class="page-sub mt-1">Bekijk je accountgegevens en ga snel door naar de belangrijkste onderdelen.</p>
    </section>

    <section class="mb-4 grid gap-4 sm:grid-cols-3">
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Naam</p>
            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Rol</p>
            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">{{ $summary['role'] }}</p>
        </article>
        <article class="card p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">E-mail</p>
            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">{{ $user->email }}</p>
        </article>
    </section>

    <section class="mb-4 grid gap-4 lg:grid-cols-[1.3fr_0.7fr]">
        <article class="card">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Snelle acties</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                <a href="{{ route('training.content') }}" class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900 hover:bg-emerald-100 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 dark:hover:bg-emerald-900">Bekijk trainingscontent</a>
                <a href="{{ route('training.index') }}" class="rounded-lg border border-sky-200 bg-sky-50 px-4 py-3 text-sm font-medium text-sky-900 hover:bg-sky-100 dark:border-sky-800 dark:bg-sky-950 dark:text-sky-300 dark:hover:bg-sky-900">Bekijk trainingen</a>
                <a href="{{ route('daycare.index') }}" class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-900 hover:bg-amber-100 dark:border-amber-800 dark:bg-amber-950 dark:text-amber-300 dark:hover:bg-amber-900">Plan dagopvang</a>
                <a href="{{ route('contact.index') }}" class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-700/50 dark:text-slate-200 dark:hover:bg-slate-700">Stel een vraag</a>
            </div>

            @if ($user->is_admin)
                <a href="{{ route('beheer.index') }}" class="mt-4 inline-flex rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600">Ga naar beheer</a>
            @endif
        </article>

        <aside class="card">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Platform overzicht</h2>
            <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-slate-400">
                <li>Actieve producten: <strong class="text-slate-900 dark:text-white">{{ $summary['products'] }}</strong></li>
                <li>Actieve trainingen: <strong class="text-slate-900 dark:text-white">{{ $summary['trainings'] }}</strong></li>
                <li>Toegang tot trainingscontent: <strong class="text-slate-900 dark:text-white">Ja</strong></li>
            </ul>
        </aside>
    </section>
@endsection
