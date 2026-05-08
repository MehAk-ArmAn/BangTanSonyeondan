{{-- Admin login page. --}}
@extends('layouts.admin.auth')
@section('title', 'Admin Login · BangTanSonyeondan')
@section('content')
<section class="login-card">
    <img src="{{ asset('favicons/logo.png') }}" alt="Logo">
    <span class="eyebrow">Private Control Room</span>
    <h1>Admin Login 💜</h1>
    <p>Manage members, songs, timeline, gallery, votes, and site settings.</p>

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@bangtansonyeondan.com" required autofocus>
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
        <label class="check-row"><input type="checkbox" name="remember" value="1"> Remember me</label>
        <button type="submit">Enter Dashboard</button>
    </form>
</section>
@endsection

