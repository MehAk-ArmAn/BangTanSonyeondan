@extends('layouts.frontend.app')

@section('title', 'Dashboard · BangTanSonyeondan')

@section('content')
<section class="dashboard-hero dashboard-skin {{ $skin['theme'] }}" style="--profile-gradient: {{ $skin['gradient'] }}">
    <div class="dashboard-identity-block">
        <span class="eyebrow">ARMY Dashboard</span>
        <h1>Hey {{ $user->displayName() }}</h1>
        <p>{{ $user->bio ?: 'Take quizzes, earn points, keep streaks, unlock profile vibes, and climb the ARMY leaderboard.' }}</p>

        <div class="dashboard-badge-row">
            <span>{{ $skin['badge'] }}</span>
            <span>{{ $skin['assetLabel'] }}</span>
            <a href="{{ $user->publicUrl() }}">View public profile →</a>
        </div>
    </div>

    <div class="dashboard-profile-card">
        <div class="dashboard-avatar-ring">
            @if($skin['avatar'])
                <img src="{{ asset($skin['avatar']) }}" alt="{{ $user->displayName() }} avatar">
            @else
                <strong>{{ $user->profileInitial() }}</strong>
            @endif
        </div>
        <b>{{ number_format($user->points) }}</b>
        <span>Total points</span>
        <small>#{{ $rank }} rank · {{ $displayStreak }} day streak</small>
    </div>
</section>

<section class="stats-grid dashboard-stats">
    <div><b>{{ $recentAttempts->count() }}</b><span>Recent quizzes</span></div>
    <div><b>{{ $checkedInToday ? 'Done' : 'Open' }}</b><span>Today streak</span></div>
    <div><b>#{{ $rank }}</b><span>Global rank</span></div>
    <div><b>{{ count($unlockedAssetIds) }}</b><span>Unlocked assets</span></div>
</section>

<section class="section-block split-showcase">
    <div class="glass-panel dashboard-action-card">
        <span class="eyebrow">Daily streak</span>
        <h2>Claim today’s ARMY energy.</h2>
        <p>Check in once per day. Longer streak means better rewards and more profile unlocks.</p>
        <form method="POST" action="{{ route('user.checkin') }}">
            @csrf
            <button class="btn primary" type="submit" {{ $checkedInToday ? 'disabled' : '' }}>
                {{ $checkedInToday ? 'Claimed today' : 'Claim today’s streak' }}
            </button>
        </form>
    </div>

    <div class="glass-panel dashboard-action-card">
        <span class="eyebrow">Quick actions</span>
        <h2>Where to go next?</h2>
        <div class="hero-actions">
            <a class="btn primary" href="{{ route('quizzes.index') }}">Play quizzes</a>
            <a class="btn ghost" href="{{ route('learn.index') }}">Learning gallery</a>
            <a class="btn ghost" href="{{ route('profile.edit') }}">Edit profile</a>
            <a class="btn ghost" href="{{ route('profiles.index') }}">ARMY profiles</a>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Learning gallery</span>
        <h2>Learn the lore, then play the quizzes.</h2>
        <p>Official links, MV studies, BTS history, fandom culture, and starter guides.</p>
    </div>

    <div class="lesson-grid">
        @forelse($materials as $material)
            <a class="lesson-card dashboard-material-card" href="{{ route('learn.show', $material->slug) }}">
                <span>{{ $material->category }}</span>
                <h3>{{ $material->title }}</h3>
                <p>{{ $material->excerpt }}</p>
                <small>{{ $material->topic_type }} · {{ $material->difficulty ?: 'Starter' }}</small>
            </a>
        @empty
            <div class="glass-panel">No learning materials are active yet.</div>
        @endforelse
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Quiz arena</span>
        <h2>Quizzes point grind.</h2>
        <p>Pick a quiz, answer questions, earn points, and unlock cooler profile styles.</p>
    </div>

    <div class="quiz-game-grid">
        @forelse($quizzes as $quiz)
            <a class="quiz-game-card difficulty-{{ $quiz->difficulty }}" href="{{ route('quizzes.show', $quiz->slug) }}">
                <div class="quiz-card-body">
                    <small>{{ ucfirst($quiz->difficulty) }} · {{ $quiz->questions_count }} questions</small>
                    <h2>{{ $quiz->title }}</h2>
                    <p>{{ $quiz->description }}</p>
                    <div class="quiz-reward-row">
                        <b>{{ number_format($quiz->points_per_question) }}</b>
                        <span>points per question</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="glass-panel">No quiz games are active yet.</div>
        @endforelse
    </div>
</section>

<section class="section-block split-showcase">
    <div class="glass-panel">
        <h2>Recent point activity</h2>
        <div class="activity-list">
            @forelse($recentPoints as $item)
                <div><span>{{ $item->reason }}</span><b>{{ $item->points > 0 ? '+' : '' }}{{ number_format($item->points) }}</b></div>
            @empty
                <p>No activity yet.</p>
            @endforelse
        </div>
    </div>

    <div class="glass-panel">
        <h2>Top ARMY leaderboard</h2>
        <div class="activity-list">
            @foreach($leaderboard as $rankNumber => $army)
                <div>
                    <span>#{{ $rankNumber + 1 }} <a href="{{ $army->publicUrl() }}">{{ $army->displayName() }}</a></span>
                    <b>{{ number_format($army->points) }}</b>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">ARMY community</span>
        <h2>Visit other public profiles.</h2>
    </div>

    <div class="public-profile-grid">
        @forelse($communityUsers as $army)
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
                <span>{{ number_format($army->points) }} points</span>
            </a>
        @empty
            <div class="glass-panel">No public profiles yet.</div>
        @endforelse
    </div>
</section>
@endsection
