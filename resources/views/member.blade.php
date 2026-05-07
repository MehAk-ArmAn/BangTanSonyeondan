{{-- Member page: full member vault instead of one basic card. --}}
@extends('layouts.frontend.app')
@section('title', ($member->stage_name ?: $member->name) . ' · Member Vault')
@push('styles')
    <link rel="icon" href="{{ $member->faviconUrl() }}" type="image/png">
@endpush
@section('content')
<section class="member-hero" style="--accent: {{ $member->accent_color ?? '#a855f7' }}">
    <div class="member-portrait">
        <img src="{{ $member->imageUrl() }}" alt="{{ $member->stage_name ?: $member->name }}">
    </div>
    <div class="member-profile-copy">
        <span class="eyebrow">{{ $member->emoji }} {{ $member->bt21_character }} · Member Vault</span>
        <h1>{{ $member->stage_name ?: $member->nickname }}</h1>
        <h2>{{ $member->name }} <small>{{ $member->korean_name }}</small></h2>
        <p class="lead">{{ $member->intro_title ?: $member->role }}</p>
        <p>{{ $member->profile_story ?: $member->quote }}</p>
        <div class="tag-row">
            @foreach(($member->skill_tags ?? []) as $tag)
                <span>{{ $tag }}</span>
            @endforeach
        </div>
    </div>
</section>

<section class="profile-layout">
    <div class="glass-panel">
        <h3>Profile Details</h3>
        <dl class="fact-list">
            <div><dt>Stage Name</dt><dd>{{ $member->stage_name ?: $member->nickname }}</dd></div>
            <div><dt>Real Name</dt><dd>{{ $member->name }}</dd></div>
            <div><dt>Role</dt><dd>{{ $member->role }}</dd></div>
            <div><dt>Birthday</dt><dd>{{ optional($member->birth_date)->format('F d, Y') ?: 'Update in admin' }}</dd></div>
            <div><dt>Birthplace</dt><dd>{{ $member->birthplace ?: 'Update in admin' }}</dd></div>
            <div><dt>BT21</dt><dd>{{ $member->bt21_character ?: 'Update in admin' }}</dd></div>
        </dl>
    </div>

    <div class="glass-panel">
        <h3>Why ARMY loves this vault</h3>
        <ul class="pretty-list">
            @forelse(($member->fun_facts ?? []) as $fact)
                <li>{{ $fact }}</li>
            @empty
                <li>Add fun facts from admin to make this page richer.</li>
            @endforelse
        </ul>
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Signature Quote</span>
        <h2>{{ $member->quote }}</h2>
    </div>
    @if($relatedQuotes->isNotEmpty())
        <div class="quote-strip">
            @foreach($relatedQuotes as $quote)
                <blockquote><p>“{{ $quote->quote }}”</p><cite>{{ $quote->source }}</cite></blockquote>
            @endforeach
        </div>
    @endif
</section>
@endsection
