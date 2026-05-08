@extends('layouts.frontend.app')
@section('title', 'Vote · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Bias Voting</span>
    <h1>Vote for your bias</h1>
    <p>Simple voting is kept from the original project, now styled with the final dark purple theme.</p>
</section>

<section class="vote-layout">
    <form class="vote-card" method="POST" action="{{ route('vote.store') }}">
        @csrf
        <label>Select member
            <select name="member_id" required>
                <option value="">Choose your bias</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->stage_name ?: $member->nickname }} — {{ $member->name }}</option>
                @endforeach
            </select>
        </label>
        <button class="btn primary" type="submit">Submit Vote</button>
    </form>

    <div class="glass-panel">
        <h2>Current voting board</h2>
        @forelse($voteStats as $stat)
            <div class="vote-stat"><span>{{ $stat->member_name }}</span><b>{{ $stat->total }}</b></div>
        @empty
            <p>No votes yet. Be the first.</p>
        @endforelse
    </div>
</section>
@endsection
