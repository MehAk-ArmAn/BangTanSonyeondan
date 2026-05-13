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
        <span class="admin-chip">Publish-ready control panel</span>
    </div>

    <div class="admin-stats-grid">
        <a href="{{ route('admin.members.index') }}">
            <span>Members</span>
            <b>{{ $membersCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.learning-materials.index') }}">
            <span>Learning Materials</span>
            <b>{{ $learningCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.quizzes.index') }}">
            <span>Quiz Games</span>
            <b>{{ $quizCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.media-gallery.index') }}">
            <span>Media Gallery</span>
            <b>{{ $mediaGalleryCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.updates.index') }}">
            <span>Latest Updates</span>
            <b>{{ $updatesCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.songs.index') }}">
            <span>Songs</span>
            <b>{{ $songsCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.bt21.index') }}">
            <span>BT21</span>
            <b>{{ $bt21Count ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.quotes.index') }}">
            <span>Quotes</span>
            <b>{{ $quotesCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.timeline.index') }}">
            <span>Timeline</span>
            <b>{{ $timelineCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.navigation.index') }}">
            <span>Nav Links</span>
            <b>{{ $navCount ?? 0 }}</b>
        </a>

        <a href="{{ route('admin.votes.index') }}">
            <span>Votes</span>
            <b>{{ $votesCount ?? 0 }}</b>
        </a>

        @if(\Illuminate\Support\Facades\Route::has('admin.users.index'))
            <a href="{{ route('admin.users.index') }}">
                <span>Users</span>
                <b>{{ $usersCount ?? 0 }}</b>
            </a>
        @endif
    </div>
</section>
@endsection
