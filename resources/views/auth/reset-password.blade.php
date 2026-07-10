@extends('layouts.app')

@section('content')
    {{-- actual password reset form using token + email --}}
    <section class="card max-w-xl">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Nieuw wachtwoord instellen</h1>
        <p class="mt-1 text-slate-600 dark:text-slate-400">Vul hieronder je nieuwe wachtwoord in om weer toegang te krijgen.</p>

        @if (session('status'))
            <p class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-900 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">{{ session('status') }}</p>
        @endif

        @include('partials.form-error-summary')

        <form action="{{ route('password.update') }}" method="post" class="mt-4 grid gap-3">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label class="grid gap-1 text-sm dark:text-slate-300">E-mail
                <input class="form-input" type="email" name="email" value="{{ old('email', $email) }}" autocomplete="email" required>
            </label>
            @error('email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror

            <label class="grid gap-1 text-sm dark:text-slate-300">Nieuw wachtwoord
                <input class="form-input" type="password" name="password" autocomplete="new-password" required>
            </label>
            @error('password') <p class="text-sm text-red-500">{{ $message }}</p> @enderror

            <label class="grid gap-1 text-sm dark:text-slate-300">Bevestig nieuw wachtwoord
                <input class="form-input" type="password" name="password_confirmation" autocomplete="new-password" required>
            </label>

            <button type="submit" class="inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-600">Wachtwoord opslaan</button>
        </form>
    </section>
@endsection
