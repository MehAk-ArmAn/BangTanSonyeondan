@extends('layouts.frontend.app')

@section('title', $profileUser->displayName() . ' · ARMY Profile')

@section('content')
<section class="public-profile-hero dashboard-skin {{ $skin['theme'] }}" style="--profile-gradient: {{ $skin['gradient'] }}">
    <div class="public-profile-avatar">
        @if($skin['avatar'])
            <img src="{{ asset($skin['avatar']) }}" alt="{{ $profileUser->displayName() }} avatar">
        @else
            <strong>{{ $profileUser->profileInitial() }}</strong>
        @endif
    </div>

    <div class="public-profile-copy">
        <span class="eyebrow">Public ARMY Profile</span>
        <h1>{{ $profileUser->displayName() }}</h1>
        <p>{{ $profileUser->bio ?: 'This ARMY has not written a bio yet.' }}</p>

        <div class="dashboard-badge-row">
            <span>{{ $skin['badge'] }}</span>
            <span>{{ number_format($profileUser->points) }} points</span>
            <span>{{ (int) $profileUser->streak_days }} day streak</span>
        </div>

        <div class="hero-actions">
            <button type="button" class="btn primary js-share-profile" data-share-url="{{ $profileUser->publicUrl() }}" data-share-title="{{ $profileUser->displayName() }} on BangTanSonyeondan">Share profile</button>
            <a class="btn ghost" href="{{ route('profiles.index') }}">Explore ARMY profiles</a>
        </div>
    </div>
</section>

<section class="section-block split-showcase">
    <div class="glass-panel">
        <h2>Recent quiz activity</h2>
        <div class="activity-list">
            @forelse($recentAttempts as $attempt)
                <div>
                    <span>{{ optional($attempt->quiz)->title ?? 'Quiz' }}</span>
                    <b>{{ $attempt->score }}/{{ $attempt->total }}</b>
                </div>
            @empty
                <p>No public quiz activity yet.</p>
            @endforelse
        </div>
    </div>

    <div class="glass-panel">
        <h2>Recent point energy</h2>
        <div class="activity-list">
            @forelse($recentPoints as $item)
                <div>
                    <span>{{ $item->reason }}</span>
                    <b>{{ $item->points > 0 ? '+' : '' }}{{ number_format($item->points) }}</b>
                </div>
            @empty
                <p>No point activity yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection