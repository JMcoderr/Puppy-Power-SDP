@php
    $title = $title ?? 'Veelgestelde vragen';
    $intro = $intro ?? null;
    $items = $items ?? [];
    $accent = $accent ?? 'emerald';

    $panelClass = match ($accent) {
        'sky' => 'border-sky-200 bg-sky-50 dark:border-sky-800 dark:bg-sky-950/40',
        'amber' => 'border-amber-200 bg-amber-50 dark:border-amber-800 dark:bg-amber-950/40',
        default => 'border-emerald-200 bg-emerald-50 dark:border-emerald-800 dark:bg-emerald-950/40',
    };
@endphp

<section class="card">
    <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="section-eyebrow">Ondersteuning</p>
            <h2 class="mt-1 text-2xl font-semibold text-slate-900 dark:text-white">{{ $title }}</h2>
        </div>
        @if ($intro)
            <p class="max-w-2xl text-sm text-slate-600 dark:text-slate-400">{{ $intro }}</p>
        @endif
    </div>

    <div class="mt-5 grid gap-3" data-accordion>
        @foreach ($items as $item)
            <article class="faq-item {{ $panelClass }}">
                <button type="button" class="faq-trigger" data-accordion-trigger aria-expanded="false">
                    <span class="text-left text-base font-semibold text-slate-900 dark:text-white">{{ $item['question'] }}</span>
                    <span class="faq-icon" aria-hidden="true">+</span>
                </button>
                <div class="faq-answer hidden" data-accordion-panel>
                    <p class="text-sm leading-6 text-slate-700 dark:text-slate-300">{{ $item['answer'] }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>