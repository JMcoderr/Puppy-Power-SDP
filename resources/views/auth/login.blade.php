@extends('layouts.app')

@section('content')
    {{-- login card for protected training content --}}
    <section class="card max-w-xl">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Inloggen</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Log in om afgeschermde trainingscontent te bekijken.</p>

        @if (session('status'))
            <p class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-900 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">{{ session('status') }}</p>
        @endif

        @include('partials.form-error-summary')

        <form action="{{ route('login.store') }}" method="post" class="mt-4 grid gap-3">
            @csrf
            <label class="grid gap-1 text-sm dark:text-slate-300">E-mail
                <input class="form-input" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
            </label>
            @error('email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm dark:text-slate-300">Wachtwoord
                <input class="form-input" type="password" name="password" autocomplete="current-password" required>
            </label>
            @error('password') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
            <label class="flex items-center gap-2 text-sm dark:text-slate-300">
                <input type="checkbox" name="remember" value="1"> Onthoud mij
            </label>
            <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600">Login</button>
        </form>

        <div class="mt-5 flex flex-wrap gap-3 text-sm">
            <a href="{{ route('register') }}" class="font-medium text-emerald-700 hover:underline dark:text-emerald-400">Nog geen account? Registreer</a>
            <a href="{{ route('password.request') }}" class="font-medium text-slate-700 hover:underline dark:text-slate-300">Wachtwoord vergeten?</a>
        </div>
    </section>
@endsection
