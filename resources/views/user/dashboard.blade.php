@extends('layouts.frontend.app')
@section('title', 'Dashboard · BangTanSonyeondan')
@section('content')
<section class="dashboard-hero" style="--profile-gradient: {{ $user->profile_theme === 'crimson-stage' ? 'linear-gradient(135deg,#7c2d12,#7f1d1d,#4c1d95)' : 'linear-gradient(135deg,#2e1065,#581c87,#111827)' }}">
    <div>
        <span class="eyebrow">ARMY Dashboard</span>
        <h1>Hey {{ $user->displayName() }} 💜</h1>
        <p>{{ $user->bio ?: 'Take quizzes, earn points, keep streaks, and climb the leaderboard.' }}</p>
    </div>
    <div class="dashboard-score-card">
        <b>{{ number_format($user->points) }}</b>
        <span>Total points</span>
        <small>{{ $user->streak_days }} day streak</small>
    </div>
</section>

<section class="stats-grid dashboard-stats">
    <div><b>{{ $recentAttempts->count() }}</b><span>Recent quizzes</span></div>
    <div><b>{{ $checkedInToday ? 'Done' : 'Open' }}</b><span>Today streak</span></div>
    <div><b>#{{ $leaderboard->search(fn($u) => $u->id === $user->id) !== false ? $leaderboard->search(fn($u) => $u->id === $user->id) + 1 : '—' }}</b><span>Visible rank</span></div>
    <div><b>{{ count($unlockedAssetIds) }}</b><span>Unlocked assets</span></div>
</section>

<section class="section-block split-showcase">
    <div class="glass-panel">
        <h2>Daily streak</h2>
        <p>Check in once per day to earn points. Longer streak = better reward.</p>
        <form method="POST" action="{{ route('user.checkin') }}">@csrf<button class="btn primary" type="submit" {{ $checkedInToday ? 'disabled' : '' }}>{{ $checkedInToday ? 'Claimed today' : 'Claim today’s streak' }}</button></form>
    </div>
    <div class="glass-panel">
        <h2>Quick actions</h2>
        <div class="hero-actions">
            <a class="btn primary" href="{{ route('learn.index') }}">Take a quiz</a>
            <a class="btn ghost" href="{{ route('profile.edit') }}">Edit profile</a>
            <a class="btn ghost" href="{{ route('leaderboard') }}">Leaderboard</a>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Lessons</span>
        <h2>Learn first, then quiz.</h2>
    </div>
    <div class="lesson-grid">
        @foreach($lessons as $lesson)
            <a class="lesson-card" href="{{ route('learn.show', $lesson->slug) }}">
                <span>{{ $lesson->category }}</span>
                <h3>{{ $lesson->title }}</h3>
                <p>{{ $lesson->excerpt }}</p>
                <small>{{ $lesson->reward_points }} possible points</small>
            </a>
        @endforeach
    </div>
</section>

<section class="section-block split-showcase">
    <div class="glass-panel">
        <h2>Recent point activity</h2>
        <div class="activity-list">
            @forelse($recentPoints as $item)
                <div><span>{{ $item->reason }}</span><b>{{ $item->points > 0 ? '+' : '' }}{{ $item->points }}</b></div>
            @empty
                <p>No activity yet.</p>
            @endforelse
        </div>
    </div>
    <div class="glass-panel">
        <h2>Top ARMY leaderboard</h2>
        <div class="activity-list">
            @foreach($leaderboard as $rank => $army)
                <div><span>#{{ $rank + 1 }} {{ $army->displayName() }}</span><b>{{ $army->points }}</b></div>
            @endforeach
        </div>
    </div>
</section>
@endsection
