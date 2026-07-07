@extends('layouts.app')

@section('content')
    <section class="card login-card">
        <h1>Inloggen</h1>
        <p>Log in om afgeschermde trainingscontent te bekijken.</p>

        <form action="{{ route('login.store') }}" method="post" class="stack-form">
            @csrf
            <label>E-mail
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>Wachtwoord
                <input type="password" name="password" required>
            </label>
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"> Onthoud mij
            </label>
            <button type="submit" class="btn">Login</button>
        </form>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <p class="hint">Demo account: test@example.com / password</p>
    </section>
@endsection
