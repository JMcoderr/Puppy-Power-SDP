@extends('layouts.app')

@section('content')
    {{-- page intro so user knows what this page is about --}}
    <section class="mb-4">
        <h1 class="page-heading">Shop</h1>
        <p class="page-sub mt-1">Ontdek cursussen en DIY-pakketten voor jou en je hond.</p>
    </section>

    <section class="grid gap-4 lg:grid-cols-[2fr_1fr]">
        <div class="grid gap-4 md:grid-cols-2">
        @forelse ($products as $product)
            <article class="card">
                {{-- colour the category badge based on its value --}}
                @php
                    $badgeClass = match($product->category) {
                        'Cursus'     => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300',
                        'DIY-pakket' => 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300',
                        default      => 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300',
                    };
                @endphp
                <p class="mb-2 inline-block rounded-full px-2 py-0.5 text-xs font-semibold {{ $badgeClass }}">{{ $product->category }}</p>
                <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">{{ $product->name }}</h2>
                <p class="page-sub">{{ $product->description }}</p>
                <p class="mt-4 text-lg font-bold text-slate-900 dark:text-white">&euro;&nbsp;{{ number_format($product->price, 2, ',', '.') }}</p>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Direct advies mogelijk via contactformulier.</p>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600">Vraag hierover</a>
            </article>
        @empty
            <article class="card">
                <h2 class="mb-2 text-xl font-semibold text-slate-900 dark:text-white">Nog geen producten</h2>
                <p class="page-sub">Er staan nu nog geen actieve producten in de shop.</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Kom later terug of stuur een vraag via contact.</p>
                <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-600">Naar contact</a>
            </article>
        @endforelse
        </div>

        <aside class="card lg:sticky lg:top-4 lg:h-fit">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Hulp bij kiezen</h2>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Twijfel je tussen producten? Vertel ons je situatie en wij geven een passend advies.</p>
            <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-slate-600 dark:text-slate-400">
                <li>Snelle reactie via contact</li>
                <li>Advies voor puppy en volwassen hond</li>
                <li>Praktische tips op jouw niveau</li>
            </ul>
            <a href="{{ route('contact.index') }}" class="mt-4 inline-flex rounded-lg bg-slate-800 px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 dark:bg-slate-600 dark:hover:bg-slate-500">Stel je vraag</a>
        </aside>
    </section>
@endsection
