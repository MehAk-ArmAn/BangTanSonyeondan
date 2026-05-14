@extends('layouts.frontend.app')
@section('title', ($siteSettings['site_title'] ?? 'BangTanSonyeondan') . ' · Home')
@section('content')
<section class="hero-section old-soul-hero">
    <div class="hero-copy">
        <span class="eyebrow">{{ $siteSettings['hero_kicker'] ?? 'BTS FOREVER · ARMY HOMEBASE' }}</span>
        <h1>{{ $siteSettings['hero_title'] ?? 'BangTanSonyeondan' }}</h1>
        <p>{{ $siteSettings['hero_body'] ?? 'Learn everything about BTS, take quizzes, earn points, collect profile upgrades, and climb the ARMY leaderboard.' }}</p>
        <div class="hero-actions">
            <a class="btn primary" href="{{ route('learn.index') }}">Start Learning</a>
            <a class="btn ghost" href="{{ route('register') }}">Create Account</a>
            <a class="btn ghost" href="{{ route('achievements') }}">Timeline</a>
        </div>
    </div>
    <div class="hero-card legacy-image-card">
        <img src="{{ asset('imgs/collage.jpg') }}" alt="BangTanSonyeondan hero">
        <div class="floating-badge">BTS · ARMY</div>
    </div>
</section>

<section class="stats-grid">
    <div><b>{{ $members->count() ?: 7 }}</b><span>Member vaults</span></div>
    <div><b>{{ $featuredSongs->count() }}</b><span>Featured songs</span></div>
    <div><b>{{ $featuredTimeline->count() }}</b><span>Timeline lessons</span></div>
    <div><b>∞</b><span>ARMY energy</span></div>
</section>

<section class="section-block split-showcase feature-quest">
    <div>
        <span class="eyebrow">Learn → Quiz → Earn</span>
        <h2>It is not just pretty. It teaches BTS, then tests you.</h2>
        <p>The final version adds user accounts, daily streaks, learning pages, quizzes, points, profile upgrades, and a leaderboard — exactly the ARMY game-learning idea.</p>
        <a class="btn primary" href="{{ route('learn.index') }}">Open BTS Lessons</a>
    </div>
    <div class="quest-cards">
        <article><span>01</span><h3>Read BTS lesson</h3><p>Short, cute, useful BTS teaching cards.</p></article>
        <article><span>02</span><h3>Take quiz</h3><p>Each correct answer gives points.</p></article>
        <article><span>03</span><h3>Upgrade profile</h3><p>Spend points on profile assets and themes.</p></article>
    </div>
</section>

<section class="section-block members-showcase-section" id="members">
    <div class="section-heading">
        <span class="eyebrow">Member Vaults</span>

        <h2>
            Seven artists. Seven identities. One universe.
        </h2>

        <p>
            Explore cinematic member profiles with stories, visuals, BT21 identities,
            skill tags, social links, and iconic BTS aesthetics.
        </p>
    </div>

    <div class="members-showcase-grid">
        @foreach($featuredMembers as $member)
            <a
                class="member-showcase-card"
                href="{{ route('member.show', $member->slug ?: $member->name) }}"
                style="--accent: {{ $member->accent_color ?? '#a855f7' }}"
            >
                <div class="member-showcase-image-wrap">
                    <img
                        src="{{ asset(member_asset($member->image)) }}"
                        alt="{{ $member->stage_name ?: $member->name }}"
                    >

                    <div class="member-showcase-overlay"></div>

                    <div class="member-showcase-glow"></div>

                    @if($member->bt21_character)
                        <span class="member-showcase-bt21">
                            {{ $member->bt21_character }}
                        </span>
                    @endif
                </div>

                <div class="member-showcase-content">
                    <span class="member-showcase-role">
                        {{ $member->role }}
                    </span>

                    <h3>
                        {{ $member->stage_name ?: $member->nickname ?: $member->name }}
                    </h3>

                    <p>
                        {{ $member->intro_title ?: 'Enter profile vault' }}
                    </p>

                    <div class="member-showcase-footer">
                        <span>Open Profile</span>

                        <div class="member-showcase-arrow">
                            →
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="section-block split-showcase">
    <div>
        <span class="eyebrow">BT21 Fixed</span>
        <h2>BT21 is now its own colorful animated anatomy zone.</h2>
        <p>No more BT21 cards leading to member vaults. They now open fun character anatomy-style profiles directly on the BT21 page.</p>
        <a class="btn primary" href="{{ route('bt21') }}">Visit BT21</a>
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
        <span class="eyebrow">Song Cards</span>
        <h2>Era browsing with dark concert energy.</h2>
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
        <blockquote><p>“Seven people. Millions of stories. One purple stage.”</p><cite>ARMY</cite></blockquote>
    @endforelse
</section>
@endsection
