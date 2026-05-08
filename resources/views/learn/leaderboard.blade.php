@extends('layouts.frontend.app')
@section('title', 'Leaderboard · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">ARMY Ranking</span>
    <h1>Leaderboard</h1>
    <p>Points come from quizzes, daily streaks, and profile activity. Admin accounts are hidden.</p>
</section>

<section class="leaderboard-panel">
    @foreach($users as $rank => $user)
        <article class="leader-row {{ $rank < 3 ? 'top-rank' : '' }}">
            <b>#{{ $rank + 1 }}</b>
            <div>
                <h3>{{ $user->displayName() }}</h3>
                <p>{{ $user->bio ?: 'BangTanSonyeondan learner' }}</p>
            </div>
            <span>{{ number_format($user->points) }} pts</span>
        </article>
    @endforeach
</section>
@endsection
