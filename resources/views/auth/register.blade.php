@extends('layouts.app')

@section('content')
    {{-- registration page for new users --}}
    <section class="card max-w-xl">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Registreren</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Maak een account aan om trainingscontent te bekijken en sneller contact op te nemen.</p>

        @include('partials.form-error-summary')

        <form action="{{ route('register.store') }}" method="post" class="mt-4 grid gap-3">
            @csrf
            <label class="grid gap-1 text-sm dark:text-slate-300">Naam
                <input class="form-input" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required>
            </label>
            @error('name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror

            <label class="grid gap-1 text-sm dark:text-slate-300">E-mail
                <input class="form-input" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
            </label>
            @error('email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror

            <label class="grid gap-1 text-sm dark:text-slate-300">Wachtwoord
                <input class="form-input" type="password" name="password" autocomplete="new-password" required>
            </label>
            @error('password') <p class="text-sm text-red-500">{{ $message }}</p> @enderror

            <label class="grid gap-1 text-sm dark:text-slate-300">Bevestig wachtwoord
                <input class="form-input" type="password" name="password_confirmation" autocomplete="new-password" required>
            </label>

            <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600">Account aanmaken</button>
        </form>

        <p class="mt-5 text-sm text-slate-600 dark:text-slate-400">
            Heb je al een account?
            <a href="{{ route('login') }}" class="font-medium text-emerald-700 hover:underline dark:text-emerald-400">Log hier in</a>
        </p>
    </section>
@endsection
