@extends('layouts.frontend.app')

@php
    $lesson = $material;
@endphp

@section('title', $lesson->title . ' · BTS Learning Gallery')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/bts-learning-cinematic.css') }}">
@endpush

@section('content')
@php
    $slug = $lesson->slug;

    $galleryImages = [
        "imgs/learn/{$slug}/gallery-1.jpg",
        "imgs/learn/{$slug}/gallery-2.jpg",
        "imgs/learn/{$slug}/gallery-3.jpg",
        "imgs/learn/{$slug}/gallery-4.jpg",
    ];

    $videoPoster = "imgs/learn/{$slug}/video-poster.jpg";

    $funFacts = [
        'This topic connects to the bigger BTS journey, not just one single song or moment.',
        'ARMY culture made this topic bigger because fans kept sharing, translating, explaining, and celebrating it.',
        'Many BTS eras have hidden meanings through visuals, lyrics, outfits, stage design, and storytelling.',
        'This section can later include verified details, official source links, and YouTube MV references.',
    ];

    $historyNotes = [
        'Early context: explain where this topic started and what BTS was trying to express.',
        'Growth moment: explain how fans reacted and how this topic became memorable.',
        'Legacy: explain why this topic still matters to new ARMYs discovering BTS today.',
    ];

    $officialLinks = [
        [
            'label' => 'Official BTS YouTube Channel',
            'url' => 'https://www.youtube.com/@BTS',
        ],
        [
            'label' => 'BANGTANTV',
            'url' => 'https://www.youtube.com/@BANGTANTV',
        ],
        [
            'label' => 'Official BTS Website',
            'url' => 'https://ibighit.com/bts/eng/',
        ],
    ];
@endphp

<section class="learn-detail-hero">
    <div class="learn-detail-bg">
        @if($lesson->image_path)
            <img src="{{ asset($lesson->image_path) }}" alt="{{ $lesson->title }}">
        @endif
    </div>

    <div class="learn-detail-overlay"></div>

    <div class="learn-detail-hero-content">
        <a class="learn-back-link" href="{{ route('learn.index') }}">← Back to Learning Gallery</a>
        <span class="eyebrow">{{ $lesson->category }}</span>
        <h1>{{ $lesson->title }}</h1>
        <p>{{ $lesson->excerpt }}</p>

        <div class="learn-detail-pills">
            <span>Story</span>
            <span>Images</span>
            <span>Videos</span>
            <span>Fun facts</span>
            <span>Official links</span>
        </div>
    </div>
</section>

<section class="learn-big-layout">
    <article class="learn-main-story">
        <div class="learn-section-title">
            <span class="eyebrow">Deep Topic Guide</span>
            <h2>Full story about {{ $lesson->title }}</h2>
        </div>

        <p>
            {{ $lesson->body ?: 'This topic is part of the bigger BangTanSonyeondan journey. Use this page as a full learning space where fans can understand the meaning, history, visuals, music, performances, and emotional connection behind this subject. Later, replace this sample text with real BTS information written in your own words.' }}
        </p>

        <p>
            BTS topics are never just random facts. Every era, MV, performance, lyric, and visual choice can connect to a larger message.
            This page should feel like a mini magazine article: easy to read, beautiful to scroll, and useful for new ARMYs who want to learn properly.
        </p>

        <p>
            Add details here about the background of this topic, what happened during that time, why fans remember it, what official content connects to it,
            and what someone should watch next. You can make this section long, emotional, and very human so it feels like a real fan guide, not boring notes.
        </p>
    </article>

    <aside class="learn-side-panel">
        <h3>Media folder for this topic</h3>
        <p>Put your downloaded images/videos here:</p>

        <code>public/imgs/learn/{{ $lesson->slug }}/</code>

        <ul>
            <li>cover.jpg</li>
            <li>gallery-1.jpg</li>
            <li>gallery-2.jpg</li>
            <li>gallery-3.jpg</li>
            <li>gallery-4.jpg</li>
            <li>video-poster.jpg</li>
        </ul>
    </aside>
</section>

<section class="learn-media-section">
    <div class="learn-section-title center">
        <span class="eyebrow">Image Gallery</span>
        <h2>Visual moments for this topic</h2>
        <p>Replace these placeholders by adding images into the topic folder.</p>
    </div>

    <div class="learn-gallery-grid">
        @foreach($galleryImages as $image)
            <div class="learn-gallery-card">
                @if(file_exists(public_path($image)))
                    <img src="{{ asset($image) }}" alt="{{ $lesson->title }} image {{ $loop->iteration }}">
                @else
                    <div class="learn-image-placeholder tall">
                        <span>Gallery image {{ $loop->iteration }}</span>
                        <small>{{ $image }}</small>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>

<section class="learn-video-zone">
    <div class="learn-video-card">
        @if(file_exists(public_path($videoPoster)))
            <img src="{{ asset($videoPoster) }}" alt="{{ $lesson->title }} video poster">
        @else
            <div class="learn-video-placeholder">
                <span>Video / MV space</span>
                <small>Add poster: public/{{ $videoPoster }}</small>
            </div>
        @endif

        <div class="learn-video-content">
            <span class="eyebrow">Watch Next</span>
            <h2>MV, stage, interview, or official clip</h2>
            <p>
                Add the official YouTube link from admin later. For now, this area is ready for
                MVs, trailers, performances, comeback stages, interviews, or behind-the-scenes videos.
            </p>
        </div>
    </div>
</section>

<section class="learn-info-grid">
    <div class="learn-info-box">
        <h2>Fun facts</h2>
        @foreach($funFacts as $fact)
            <p>✦ {{ $fact }}</p>
        @endforeach
    </div>

    <div class="learn-info-box">
        <h2>History notes</h2>
        @foreach($historyNotes as $note)
            <p>✦ {{ $note }}</p>
        @endforeach
    </div>
</section>

<section class="learn-links-panel">
    <div>
        <span class="eyebrow">Official Content</span>
        <h2>Useful links</h2>
        <p>Use official links whenever possible so the site feels trusted and clean.</p>
    </div>

    <div class="learn-official-links">
        @foreach($officialLinks as $link)
            <a href="{{ $link['url'] }}" target="_blank" rel="noopener">
                {{ $link['label'] }} →
            </a>
        @endforeach
    </div>
</section>
@endsection
