@extends('layouts.app')

@section('content')
    {{-- request form for a password reset --}}
    <section class="card max-w-xl">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Wachtwoord vergeten</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Vul je e-mailadres in. Daarna kun je meteen een nieuw wachtwoord instellen.</p>

        @include('partials.form-error-summary')

        <form action="{{ route('password.email') }}" method="post" class="mt-4 grid gap-3">
            @csrf
            <label class="grid gap-1 text-sm dark:text-slate-300">E-mail
                <input class="form-input" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
            </label>
            @error('email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror

            <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600">Verder naar reset</button>
        </form>
    </section>
@endsection
