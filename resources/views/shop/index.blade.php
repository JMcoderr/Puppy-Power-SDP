@extends('layouts.app')

@section('content')
    {{-- page intro so user knows what this page is about --}}
    <section class="page-head mb-4">
        <h1 class="text-3xl font-bold text-slate-900">Shop</h1>
        <p class="mt-1 text-slate-600">Ontdek cursussen en DIY-pakketten voor jou en je hond.</p>
    </section>

    <section class="cards-grid grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($products as $product)
            <article class="card rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="tag mb-2 text-xs font-semibold uppercase tracking-wide text-emerald-700">{{ $product->category }}</p>
                <h2 class="mb-2 text-xl font-semibold text-slate-900">{{ $product->name }}</h2>
                <p class="text-slate-600">{{ $product->description }}</p>
                <p class="price mt-4 text-lg font-bold text-slate-900">EUR {{ number_format($product->price, 2, ',', '.') }}</p>
                <a href="{{ route('contact.index') }}" class="btn btn-small mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800">Vraag hierover</a>
            </article>
        @empty
            <article class="card rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="mb-2 text-xl font-semibold text-slate-900">Nog geen producten</h2>
                <p class="text-slate-600">Er staan nu nog geen actieve producten in de shop.</p>
                <p class="hint mt-2 text-sm text-slate-500">Kom later terug of stuur een vraag via contact.</p>
                <a href="{{ route('contact.index') }}" class="btn btn-small mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800">Naar contact</a>
            </article>
        @endforelse
    </section>
@endsection
