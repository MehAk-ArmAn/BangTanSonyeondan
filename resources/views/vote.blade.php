@extends('layouts.frontend.app')

@section('title', 'Vote · BangTanSonyeondan')

@section('content')
<section class="page-hero small">
    <span class="eyebrow">Bias Voting</span>
    <h1>Vote for your bias</h1>
    <p>Every account can vote once only. Choose carefully — your ARMY vote gets locked.</p>
</section>

@if(session('success'))
    <div class="public-alert success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="public-alert error">{{ session('error') }}</div>
@endif

<section class="vote-layout">
    @auth
        <form class="vote-card" method="POST" action="{{ route('vote.store') }}">
            @csrf

            <label>Select member
                <select name="member_id" class="input" required {{ $hasVoted ? 'disabled' : '' }}>
                    <option value="">Choose your bias 💜</option>

                    @foreach($members as $member)
                        <option value="{{ $member->id }}">
                            {!! spark_name($member->stage_name ?: ($member->nickname ?: $member->name)) !!}
                        </option>
                    @endforeach
                </select>
            </label>

            <button class="btn primary" type="submit" {{ $hasVoted ? 'disabled' : '' }}>
                {{ $hasVoted ? 'You already voted' : 'Submit Vote' }}
            </button>

            @if($hasVoted)
                <p class="form-note">You can only vote once. Your vote is already locked.</p>
            @endif
        </form>
    @else
        <div class="vote-card">
            <h2>Login to vote</h2>
            <p class="form-note">You need an account so every ARMY can vote only once.</p>
            <a class="btn primary" href="{{ route('login') }}">Login</a>
        </div>
    @endauth

    <div class="glass-panel">
        <h2>Current voting board</h2>

        @forelse($voteStats as $stat)
            <div class="vote-stat">
                <span>{{ $stat->member_name }}</span>
                <b>{{ $stat->total }}</b>
            </div>
        @empty
            <p>No votes yet. Be the first.</p>
        @endforelse
    </div>
</section>
@endsection
