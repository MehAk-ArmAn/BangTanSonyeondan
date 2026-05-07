{{-- Vote page with DB-backed member options and result stats. --}}
@extends('layouts.frontend.app')
@section('title', 'Vote · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Bias Check</span>
    <h1>Vote for your bias 💜</h1>
    <p>Votes are now saved in the database and visible in the admin panel.</p>
</section>
@if(session('success'))<div class="public-alert success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="public-alert error">{{ $errors->first() }}</div>@endif
<section class="vote-layout">
    <form class="vote-card" action="{{ route('vote.store') }}" method="POST">
        @csrf
        <label for="member_id">Choose your BTS member</label>
        <select id="member_id" name="member_id" required>
            <option value="">Select member...</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->emoji }} {{ $member->stage_name ?: $member->nickname }} — {{ $member->name }}</option>
            @endforeach
        </select>
        <button class="btn primary" type="submit">Submit Vote 🎉</button>
    </form>

    <div class="glass-panel">
        <h3>Live Vote Board</h3>
        @forelse($voteStats as $stat)
            <div class="vote-stat"><span>{{ $stat->member_name }}</span><b>{{ $stat->total }}</b></div>
        @empty
            <p>No votes yet. Be the first ARMY to start the board.</p>
        @endforelse
    </div>
</section>
@endsection
