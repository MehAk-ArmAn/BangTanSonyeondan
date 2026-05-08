@extends('layouts.frontend.app')
@section('title', 'Join ARMY · BangTanSonyeondan')
@section('content')
<section class="auth-shell">
    <div class="auth-copy">
        <span class="eyebrow">Create account</span>
        <h1>Join the BangTanSonyeondan learning hub.</h1>
        <p>Registration gives you starter points, a profile dashboard, quiz access, streaks, and leaderboard ranking.</p>
    </div>
    <form method="POST" action="{{ route('register.store') }}" class="auth-card">
        @csrf
        <label>Name<input type="text" name="name" value="{{ old('name') }}" required autocomplete="name"></label>
        <label>Username<input type="text" name="username" value="{{ old('username') }}" placeholder="mehak_army" autocomplete="username"></label>
        <label>Email<input type="email" name="email" value="{{ old('email') }}" required autocomplete="email"></label>
        <label>Password<input type="password" name="password" required autocomplete="new-password"></label>
        <label>Confirm Password<input type="password" name="password_confirmation" required autocomplete="new-password"></label>
        <button class="btn primary" type="submit">Create account + get 50 points</button>
        <a class="btn ghost" href="{{ route('google.notice') }}">Continue with Google</a>
        <p class="form-note">Already registered? <a href="{{ route('login') }}">Login</a></p>
    </form>
</section>
@endsection
