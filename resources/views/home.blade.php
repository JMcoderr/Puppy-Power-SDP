@extends('layouts.app')

@section('content')
    <section class="hero">
        <p class="tag">Jouw complete hondenplatform</p>
        <h1>Welkom bij Puppy Power Academy</h1>
        <p>
            Shop, training en dagopvang op een plek. Voor nieuwe en ervaren hondeneigenaren.
        </p>
        <div class="hero-actions">
            <a class="btn" href="{{ route('shop.index') }}">Bekijk de shop</a>
        </div>
    </section>

    <section class="cards-grid">
        <article class="card">
            <h2>Shop</h2>
            <p>Cursussen en DIY-pakketten die je direct kunt bestellen.</p>
        </article>
        <article class="card">
            <h2>Training</h2>
            <p>Puppytraining, gedragstraining en hulp bij vuurwerkangst.</p>
        </article>
        <article class="card">
            <h2>Dagopvang</h2>
            <p>Betrouwbare opvang met heldere planning en aanmeldingen.</p>
        </article>
    </section>
@endsection
