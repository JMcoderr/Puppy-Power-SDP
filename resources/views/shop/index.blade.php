@extends('layouts.app')

@section('content')
    {{-- page intro so user knows what this page is about --}}
    <section class="page-head">
        <h1>Shop</h1>
        <p>Ontdek cursussen en DIY-pakketten voor jou en je hond.</p>
    </section>

    <section class="cards-grid">
        @forelse ($products as $product)
            <article class="card">
                <p class="tag">{{ $product->category }}</p>
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p class="price">EUR {{ number_format($product->price, 2, ',', '.') }}</p>
                <a href="{{ route('contact.index') }}" class="btn btn-small">Vraag hierover</a>
            </article>
        @empty
            <article class="card">
                <h2>Nog geen producten</h2>
                <p>Er staan nu nog geen actieve producten in de shop.</p>
                <p class="hint">Kom later terug of stuur een vraag via contact.</p>
                <a href="{{ route('contact.index') }}" class="btn btn-small">Naar contact</a>
            </article>
        @endforelse
    </section>
@endsection
