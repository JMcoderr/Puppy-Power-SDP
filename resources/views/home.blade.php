@extends('layouts.app')

@section('content')
    {{-- quick intro block so users instantly know what this site is --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-8">
        <p class="mb-2 text-sm font-semibold text-emerald-700">Jouw complete hondenplatform</p>
        <h1 class="mb-3 text-3xl font-bold text-slate-900 md:text-4xl">Welkom bij Puppy Power Academy</h1>
        <p class="max-w-2xl text-slate-600">
            Shop, training en dagopvang op een plek. Voor nieuwe en ervaren hondeneigenaren.
        </p>
        <div class="mt-5 flex flex-wrap gap-2">
            <a class="inline-flex rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800" href="{{ route('shop.index') }}">Bekijk de shop</a>
            <a class="inline-flex rounded-lg bg-sky-700 px-4 py-2 text-sm font-medium text-white hover:bg-sky-800" href="{{ route('training.index') }}">Bekijk trainingen</a>
            <a class="inline-flex rounded-lg bg-slate-700 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800" href="{{ route('daycare.index') }}">Plan dagopvang</a>
        </div>
    </section>

    {{-- service cards like in the wireframe: each card has short text + action --}}
    <section class="mt-5 grid gap-4 md:grid-cols-3">
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="mb-2 text-xl font-semibold text-slate-900">Shop</h2>
            <p class="text-slate-600">Cursussen en DIY-pakketten die je direct kunt bestellen.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800" href="{{ route('shop.index') }}">Ga naar shop</a>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="mb-2 text-xl font-semibold text-slate-900">Training</h2>
            <p class="text-slate-600">Puppytraining, gedragstraining en hulp bij vuurwerkangst.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800" href="{{ route('training.index') }}">Ga naar training</a>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="mb-2 text-xl font-semibold text-slate-900">Dagopvang</h2>
            <p class="text-slate-600">Betrouwbare opvang met heldere planning en aanmeldingen.</p>
            <a class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800" href="{{ route('daycare.index') }}">Ga naar dagopvang</a>
        </article>
    </section>

    {{-- little extra info row so page feels complete --}}
    <section class="mt-4 grid gap-4 md:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-slate-100 p-5">
            <h3 class="mb-2 text-lg font-semibold text-slate-900">Voor wie?</h3>
            <p class="text-slate-600">Voor puppy-eigenaren en ervaren baasjes die structuur en hulp zoeken.</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-slate-100 p-5">
            <h3 class="mb-2 text-lg font-semibold text-slate-900">Hoe snel starten?</h3>
            <p class="text-slate-600">Je kunt direct een training kiezen of dagopvang aanvragen via de formulieren.</p>
        </article>
    </section>
@endsection
