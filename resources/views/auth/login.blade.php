@extends('layouts.frontend.app')
@section('title', 'Login · BangTanSonyeondan')
@section('content')
<section class="auth-shell">
    <div class="auth-copy">
        <span class="eyebrow">Welcome back</span>
        <h1>Login to your ARMY dashboard.</h1>
        <p>Continue your streak, take BTS quizzes, earn points, and upgrade your profile.</p>
    </div>
    <form method="POST" action="{{ route('login.store') }}" class="auth-card">
        @csrf
        <label>Email<input type="email" name="email" value="{{ old('email') }}" required autocomplete="email"></label>
        <label>Password<input type="password" name="password" required autocomplete="current-password"></label>
        <label class="check-row"><input type="checkbox" name="remember" value="1"> Remember me</label>
        <button class="btn primary" type="submit">Login</button>
        <a class="btn ghost" href="{{ route('google.notice') }}">Continue with Google</a>
        <p class="form-note">New here? <a href="{{ route('register') }}">Create an account</a></p>
    </form>
</section>
@endsection
