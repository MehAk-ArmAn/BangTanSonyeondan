{{-- Home page: cinematic fan archive landing page. --}}
@extends('layouts.frontend.app')
@section('title', ($siteSettings['site_title'] ?? 'BangTanSonyeondan Archive') . ' · Home')
@section('content')
<section class="hero-section">
    <div class="hero-copy">
        <span class="eyebrow">{{ $siteSettings['hero_kicker'] ?? '⟭⟬ BTS FOREVER ⟬⟭' }}</span>
        <h1>{{ $siteSettings['hero_title'] ?? 'Your cinematic BTS archive.' }}</h1>
        <p>{{ $siteSettings['hero_body'] ?? 'Member vaults, songs, quotes, timelines, gallery moments, and ARMY energy in one clean purple universe.' }}</p>
        <div class="hero-actions">
            <a class="btn primary" href="#members">Enter Member Vaults</a>
            <a class="btn ghost" href="{{ route('achievements') }}">Explore Timeline</a>
        </div>
    </div>
    <div class="hero-card">
        <img src="{{ asset('imgs/btsssss.jfif') }}" alt="BTS archive hero">
        <div class="floating-badge">방탄소년단 · ARMY</div>
    </div>
</section>

<section class="stats-grid">
    <div><b>{{ $members->count() ?: 7 }}</b><span>Member vaults</span></div>
    <div><b>{{ $featuredSongs->count() }}</b><span>Featured songs</span></div>
    <div><b>{{ $featuredTimeline->count() }}</b><span>Timeline highlights</span></div>
    <div><b>∞</b><span>ARMY energy</span></div>
</section>

<section class="section-block" id="members">
    <div class="section-heading">
        <span class="eyebrow">Member Vaults</span>
        <h2>Not just cards — actual profiles with personality.</h2>
        <p>Each member page has profile details, tags, facts, story-style text, and their own vibe.</p>
    </div>
    <div class="member-grid">
        @foreach($featuredMembers as $member)
            <a class="member-tile" href="{{ route('member.show', $member->slug ?: $member->name) }}" style="--accent: {{ $member->accent_color ?? '#a855f7' }}">
                <img src="{{ $member->imageUrl() }}" alt="{{ $member->stage_name ?: $member->name }}">
                <div>
                    <span>{{ $member->emoji }} {{ $member->bt21_character }}</span>
                    <h3>{{ $member->stage_name ?: $member->nickname }}</h3>
                    <p>{{ $member->intro_title ?: $member->role }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="section-block split-showcase">
    <div>
        <span class="eyebrow">Archive Style</span>
        <h2>Clean like an archive, fun like an ARMY group chat.</h2>
        <p>This site now has a stronger system: database-driven members, nav, songs, quotes, gallery, timeline, voting, settings, and admin controls.</p>
        <a class="btn primary" href="{{ route('songs') }}">Browse Songs</a>
    </div>
    <div class="timeline-mini">
        @foreach($featuredTimeline as $event)
            <article>
                <span>{{ $event->year }} · {{ $event->category }}</span>
                <h3>{{ $event->title }}</h3>
            </article>
        @endforeach
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Latest Song Cards</span>
        <h2>Era browsing, not boring thumbnails.</h2>
    </div>
    <div class="song-grid compact">
        @foreach($featuredSongs as $song)
            <a class="song-card" href="{{ route('songs') }}">
                <img src="{{ asset($song->img_path) }}" alt="{{ $song->name }}">
                <div>
                    <span>{{ $song->era }}</span>
                    <h3>{{ $song->name }}</h3>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="section-block quote-strip">
    @forelse($featuredQuotes as $quote)
        <blockquote>
            <p>“{{ $quote->quote }}”</p>
            <cite>{{ $quote->source }}</cite>
        </blockquote>
    @empty
        <blockquote><p>“Seven people. Millions of stories. One purple universe.”</p><cite>ARMY</cite></blockquote>
    @endforelse
</section>
@endsection
