@extends('layouts.frontend.app')

@section('title', 'ARMY Profiles · BangTanSonyeondan')

@section('content')
<section class="page-hero small">
    <span class="eyebrow">ARMY Community</span>
    <h1>Public profiles</h1>
    <p>Explore other ARMY profiles, see points, streaks, and share your own profile link.</p>
</section>

<form class="big-search-card" action="{{ route('profiles.index') }}" method="GET">
    <input type="search" name="q" value="{{ $query }}" placeholder="Search by name, username, or bio...">
    <button type="submit">Search</button>
</form>

<div class="public-profile-grid community-grid">
    @forelse($users as $army)
        <a class="public-mini-profile" href="{{ $army->publicUrl() }}">
            <div class="public-mini-avatar">
                @if($army->avatar_key)
                    <img src="{{ asset($army->avatar_key) }}" alt="{{ $army->displayName() }} avatar">
                @else
                    <strong>{{ $army->profileInitial() }}</strong>
                @endif
            </div>
            <h3>{{ $army->displayName() }}</h3>
            <p>{{ $army->bio ?: 'ARMY profile' }}</p>
            <span>{{ number_format($army->points) }} points · {{ (int) $army->streak_days }} streak</span>
        </a>
    @empty
        <div class="glass-panel profile-empty-state">
            <h2>No public profiles found.</h2>
            <p>Try another search or make your own profile public.</p>
        </div>
    @endforelse
</div>

<div class="admin-pagination public-pagination">
    {{ $users->links() }}
</div>
@endsection