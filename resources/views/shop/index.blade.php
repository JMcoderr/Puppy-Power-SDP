@extends('layouts.app')

@section('content')
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
            </article>
        @empty
            <p>Er staan nog geen producten in de shop.</p>
        @endforelse
    </section>
@endsection
