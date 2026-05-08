@extends('layouts.frontend.app')
@section('title', 'Google Login Setup · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Google API ready-note</span>
    <h1>Google login button is placed safely.</h1>
    <p>This package keeps email/password login fully working. For real Google login, add Laravel Socialite credentials in production: Google Client ID, Client Secret, and callback URL. I kept the button visible but did not hardcode fake API keys because that would be insecure.</p>
    <div class="hero-actions">
        <a class="btn primary" href="{{ route('register') }}">Use email registration</a>
        <a class="btn ghost" href="{{ route('login') }}">Back to login</a>
    </div>
</section>
@endsection
