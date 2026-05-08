@extends('layouts.admin.app')
@section('title', 'Dashboard · BTS Admin')
@section('page_heading', 'Dashboard 💜')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Control room</p>
            <h2>BangTanSonyeondan Admin</h2>
        </div>
        <span class="admin-chip">Separate pages mode</span>
    </div>

    <div class="admin-stats-grid">
        <a href="{{ route('admin.members.index') }}"><span>Members</span><b>{{ $membersCount }}</b></a>
        <a href="{{ route('admin.songs.index') }}"><span>Songs</span><b>{{ $songsCount }}</b></a>
        <a href="{{ route('admin.gallery.index') }}"><span>Gallery</span><b>{{ $galleryCount }}</b></a>
        <a href="{{ route('admin.bt21.index') }}"><span>BT21</span><b>{{ $bt21Count }}</b></a>
        <a href="{{ route('admin.quotes.index') }}"><span>Quotes</span><b>{{ $quotesCount }}</b></a>
        <a href="{{ route('admin.timeline.index') }}"><span>Timeline</span><b>{{ $timelineCount }}</b></a>
        <a href="{{ route('admin.navigation.index') }}"><span>Nav Links</span><b>{{ $navCount }}</b></a>
        <a href="{{ route('admin.votes.index') }}"><span>Votes</span><b>{{ $votesCount }}</b></a>
    </div>
</section>
@endsection
