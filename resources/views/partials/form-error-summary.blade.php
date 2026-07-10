@if ($errors->any())
    {{-- simple top error box so user quickly sees what is wrong --}}
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-800" role="alert" aria-live="polite">
        <p class="font-semibold">Please check your input:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
