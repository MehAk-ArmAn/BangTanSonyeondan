{{-- Songs page. --}}
@extends('layouts.frontend.app')
@section('title', 'Songs Â· BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Discography Moodboard</span>
    <h1>Songs & Eras</h1>
    <p>Not just pictures â€” each song card has era, date, and a short fan-friendly description.</p>
</section>
@if($eras->isNotEmpty())
    <div class="filter-pills">
        @foreach($eras as $era)<span>{{ $era }}</span>@endforeach
    </div>
@endif
<div class="song-grid">
    @foreach($songs as $song)
        <article class="song-card">
            <img src="{{ asset($song->img_path) }}" alt="{{ $song->name }}">
            <div>
                <span>{{ $song->era ?: 'BTS' }} Â· {{ optional($song->release_date)->format('M d, Y') }}</span>
                <h3>{{ $song->name }}</h3>
                <p>{{ $song->description }}</p>
                @if($song->spotify_url)<a href="{{ $song->spotify_url }}" target="_blank">Listen â†—</a>@endif
            </div>
        </article>
    @endforeach
</div>
@endsection

