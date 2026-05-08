@extends('layouts.frontend.app')
@section('title', ($member->stage_name ?: $member->name) . ' · Member Vault')
@section('content')
<section class="member-hero" style="--accent: {{ $member->accent_color ?? '#a855f7' }}">
    <div class="member-portrait">
        <img src="{{ $member->imageUrl() }}" alt="{{ $member->stage_name ?: $member->name }}">
    </div>
    <div class="member-profile-copy">
        <span class="eyebrow">{{ $member->emoji }} · {{ $member->bt21_character }} · Member Vault</span>
        <h1>{{ $member->stage_name ?: $member->nickname }}</h1>
        <h2>{{ $member->name }}</h2>
        <small>{{ $member->role }}</small>
        <p class="lead">{{ $member->intro_title }}</p>
        <p>{{ $member->quote }}</p>
        <div class="tag-row">
            @foreach($member->skill_tags ?? [] as $tag)
                <span>{{ $tag }}</span>
            @endforeach
        </div>
    </div>
</section>

<section class="profile-layout">
    <div class="glass-panel">
        <h2>Profile story</h2>
        <p>{{ $member->profile_story }}</p>
        <dl class="fact-list">
            <div><dt>Birth date</dt><dd>{{ optional($member->birth_date)->format('M d, Y') ?: 'N/A' }}</dd></div>
            <div><dt>Birthplace</dt><dd>{{ $member->birthplace ?: 'N/A' }}</dd></div>
            <div><dt>BT21</dt><dd>{{ $member->bt21_character ?: 'N/A' }}</dd></div>
            <div><dt>Role</dt><dd>{{ $member->role }}</dd></div>
        </dl>
    </div>
    <div class="glass-panel">
        <h2>Fun facts</h2>
        <ul class="pretty-list">
            @foreach($member->fun_facts ?? [] as $fact)
                <li>{{ $fact }}</li>
            @endforeach
        </ul>
        <div class="hero-actions">
            @if($member->spotify_url)<a class="btn ghost" href="{{ $member->spotify_url }}" target="_blank">Spotify</a>@endif
            @if($member->instagram_url)<a class="btn ghost" href="{{ $member->instagram_url }}" target="_blank">Instagram</a>@endif
            <a class="btn primary" href="{{ route('bt21') }}">See BT21 character</a>
        </div>
    </div>
</section>

@if($relatedQuotes->isNotEmpty())
<section class="section-block quote-grid">
    @foreach($relatedQuotes as $quote)
        <article class="quote-card">
            <span>{{ $quote->context }}</span>
            <p>“{{ $quote->quote }}”</p>
            <h3>{{ $quote->source }}</h3>
        </article>
    @endforeach
</section>
@endif
@endsection
