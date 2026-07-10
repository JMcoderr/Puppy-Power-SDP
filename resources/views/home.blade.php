@extends('layouts.app')

@section('content')
    {{-- quick intro block so users instantly know what this site is --}}
    <section class="hero">
        <p class="tag">Jouw complete hondenplatform</p>
        <h1>Welkom bij Puppy Power Academy</h1>
        <p>
            Shop, training en dagopvang op een plek. Voor nieuwe en ervaren hondeneigenaren.
        </p>
        <div class="hero-actions">
            <a class="btn" href="{{ route('shop.index') }}">Bekijk de shop</a>
            <a class="btn btn-alt" href="{{ route('training.index') }}">Bekijk trainingen</a>
            <a class="btn btn-soft" href="{{ route('daycare.index') }}">Plan dagopvang</a>
        </div>
    </section>

    {{-- service cards like in the wireframe: each card has short text + action --}}
    <section class="cards-grid">
        <article class="card">
            <h2>Shop</h2>
            <p>Cursussen en DIY-pakketten die je direct kunt bestellen.</p>
            <a class="btn btn-small" href="{{ route('shop.index') }}">Ga naar shop</a>
        </article>
        <article class="card">
            <h2>Training</h2>
            <p>Puppytraining, gedragstraining en hulp bij vuurwerkangst.</p>
            <a class="btn btn-small" href="{{ route('training.index') }}">Ga naar training</a>
        </article>
        <article class="card">
            <h2>Dagopvang</h2>
            <p>Betrouwbare opvang met heldere planning en aanmeldingen.</p>
            <a class="btn btn-small" href="{{ route('daycare.index') }}">Ga naar dagopvang</a>
        </article>
    </section>

    {{-- little extra info row so page feels complete --}}
    <section class="quick-info">
        <article class="quick-info-card">
            <h3>Voor wie?</h3>
            <p>Voor puppy-eigenaren en ervaren baasjes die structuur en hulp zoeken.</p>
        </article>
        <article class="quick-info-card">
            <h3>Hoe snel starten?</h3>
            <p>Je kunt direct een training kiezen of dagopvang aanvragen via de formulieren.</p>
        </article>
    </section>
@endsection
