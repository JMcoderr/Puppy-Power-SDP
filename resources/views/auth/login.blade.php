@extends('layouts.app')

@section('content')
    {{-- login card for protected training content --}}
    <section class="card login-card max-w-xl rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <h1 class="text-3xl font-bold text-slate-900">Inloggen</h1>
        <p class="mt-1 text-slate-600">Log in om afgeschermde trainingscontent te bekijken.</p>

        <form action="{{ route('login.store') }}" method="post" class="stack-form mt-4 grid gap-3">
            @csrf
            <label class="grid gap-1 text-sm">E-mail
                <input class="rounded-md border border-slate-300 px-3 py-2" type="email" name="email" value="{{ old('email') }}" required>
            </label>
            @error('email') <p class="error">{{ $message }}</p> @enderror
            <label class="grid gap-1 text-sm">Wachtwoord
                <input class="rounded-md border border-slate-300 px-3 py-2" type="password" name="password" required>
            </label>
            @error('password') <p class="error">{{ $message }}</p> @enderror
            <label class="checkbox flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" value="1"> Onthoud mij
            </label>
            <button type="submit" class="btn inline-flex w-fit rounded-lg bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Login</button>
        </form>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <p class="hint mt-3 text-sm text-slate-500">Demo account: test@example.com / password</p>
    </section>
@endsection
