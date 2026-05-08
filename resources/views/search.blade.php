@extends('layouts.frontend.app')

@section('title', 'Search BangTanSonyeondan')

@section('content')
<section class="page-shell search-page">
    <div class="section-heading center">
        <p class="eyebrow">Find your way around the ARMY hub</p>
        <h1>Search BangTanSonyeondan</h1>
        <p>Search members, songs, quotes, BTS timeline moments, and learning lessons from one place.</p>
    </div>

    <form class="big-search-card" action="{{ route('search') }}" method="GET">
        <input type="search" name="q" value="{{ $query }}" placeholder="Try: Jung Kook, Dynamite, ARMY, BT21, Grammy..." autofocus>
        <button type="submit">Search</button>
    </form>

    @if($query === '')
        <div class="empty-state-card">
            Type anything above and I will pull matching pages from the whole site.
        </div>
    @else
        <div class="search-summary">Showing results for <strong>{{ $query }}</strong></div>

        @php($total = collect($results)->sum(fn($items) => $items->count()))
        @if($total === 0)
            <div class="empty-state-card">No matches yet. Try another keyword like a member name, song, year, or quote.</div>
        @else
            <div class="search-result-stack">
                @if($results['members']->isNotEmpty())
                    <div class="result-panel">
                        <h2>Members</h2>
                        <div class="mini-card-grid">
                            @foreach($results['members'] as $member)
                                <a class="mini-result-card" href="{{ route('member.show', $member->slug ?: $member->name) }}">
                                    <strong>{{ $member->stage_name ?: $member->nickname ?: $member->name }}</strong>
                                    <span>{{ $member->role }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($results['songs']->isNotEmpty())
                    <div class="result-panel">
                        <h2>Songs</h2>
                        <div class="mini-card-grid">
                            @foreach($results['songs'] as $song)
                                <a class="mini-result-card" href="{{ route('songs') }}#song-{{ $song->id }}">
                                    <strong>{{ $song->name }}</strong>
                                    <span>{{ $song->era ?: 'BTS discography' }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($results['quotes']->isNotEmpty())
                    <div class="result-panel">
                        <h2>Quotes</h2>
                        <div class="mini-card-grid">
                            @foreach($results['quotes'] as $quote)
                                <a class="mini-result-card" href="{{ route('quotes') }}#quote-{{ $quote->id }}">
                                    <strong>{{ $quote->source }}</strong>
                                    <span>{{ Str::limit($quote->quote, 90) }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($results['timeline']->isNotEmpty())
                    <div class="result-panel">
                        <h2>Timeline</h2>
                        <div class="mini-card-grid">
                            @foreach($results['timeline'] as $event)
                                <a class="mini-result-card" href="{{ route('achievements') }}#timeline-{{ $event->id }}">
                                    <strong>{{ $event->year }} - {{ $event->title }}</strong>
                                    <span>{{ $event->category }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($results['lessons']->isNotEmpty())
                    <div class="result-panel">
                        <h2>Learning Lessons</h2>
                        <div class="mini-card-grid">
                            @foreach($results['lessons'] as $lesson)
                                <a class="mini-result-card" href="{{ route('learn.show', $lesson->slug) }}">
                                    <strong>{{ $lesson->title }}</strong>
                                    <span>{{ $lesson->category }} - +{{ $lesson->reward_points }} pts</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @endif
</section>
@endsection
