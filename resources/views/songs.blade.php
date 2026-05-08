@extends('layouts.frontend.app')
@section('title', 'Songs · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Song Playlist</span>
    <h1>Songs & Eras</h1>
    <p>Song cards with era, release date, and short fan-friendly descriptions.</p>
</section>

<section class="song-grid">
    @foreach($songs as $song)
        <article class="song-card" id="song-{{ $song->id }}">
            <img src="{{ asset($song->img_path) }}" alt="{{ $song->name }}">
            <div>
                <span>{{ $song->era ?: 'BTS' }} · {{ optional($song->release_date)->format('M d, Y') }}</span>
                <h3>{{ $song->name }}</h3>
                <p>{{ $song->description }}</p>
                @if($song->spotify_url)<a href="{{ $song->spotify_url }}" target="_blank">Listen</a>@endif
            </div>
        </article>
    @endforeach
</section>
@endsection
