@extends('layouts.admin.app')
@section('title', 'Votes · BTS Admin')
@section('page_heading', 'Vote Results')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Community</p><h2>Member Voting Results</h2></div></div>
    <div class="admin-stats-grid">
        @forelse($voteStats as $stat)
            <div><span>{{ $stat->member_name }}</span><b>{{ $stat->total }}</b></div>
        @empty
            <p>No votes yet.</p>
        @endforelse
    </div>
</section>
@endsection
