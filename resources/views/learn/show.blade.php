@extends('layouts.frontend.app')

@php
    $learningAsset = function ($path) {
        $path = trim((string) $path);

        if ($path === '') {
            return null;
        }

        // External links stay untouched.
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Already has folder path.
        if (
            str_starts_with($path, 'learning/') ||
            str_starts_with($path, 'media-gallery/') ||
            str_starts_with($path, 'imgs/') ||
            str_starts_with($path, 'storage/')
        ) {
            return $path;
        }

        // Plain filename becomes public/learning/filename
        return 'learning/' . ltrim($path, '/');
    };
    $lesson = $material ?? $lesson;

    $decodeList = function ($value) {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && trim($value) !== '') {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    };

    $galleryImages = collect($decodeList($lesson->gallery_images ?? []))
        ->filter()
        ->values();

    $funFacts = collect($decodeList($lesson->fun_facts ?? []))
        ->filter()
        ->values();

    $historyNotes = collect($decodeList($lesson->history_notes ?? []))
        ->filter()
        ->values();

    $savedLinks = collect($decodeList($lesson->links ?? []))
        ->filter(fn ($link) => !empty($link['url'] ?? null))
        ->values();

    $officialLinks = collect();

    if (!empty($lesson->official_url)) {
        $officialLinks->push([
            'label' => $lesson->source_label ?: 'Official source',
            'url' => $lesson->official_url,
            'type' => 'Official',
        ]);
    }

    if (!empty($lesson->youtube_url)) {
        $officialLinks->push([
            'label' => 'Official video',
            'url' => $lesson->youtube_url,
            'type' => 'Video',
        ]);
    }

    $officialLinks = $officialLinks
        ->merge($savedLinks)
        ->unique('url')
        ->values();

    $videoPoster = $lesson->video_poster ?: $lesson->image_path;

    $youtubeEmbed = null;

    if (!empty($lesson->youtube_url)) {
        if (str_contains($lesson->youtube_url, 'embed/')) {
            $youtubeEmbed = $lesson->youtube_url;
        } elseif (preg_match('/(?:v=|youtu\.be\/|shorts\/)([A-Za-z0-9_-]{6,})/', $lesson->youtube_url, $matches)) {
            $youtubeEmbed = 'https://www.youtube.com/embed/' . $matches[1];
        }
    }
@endphp

@section('title', $lesson->title . ' · BTS Learning Gallery')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bts-learning-cinematic.css') }}">
@endpush

@section('content')
<section class="learn-detail-hero">
    <div class="learn-detail-bg">
        @if(!empty($lesson->image_path))
            <img src="{{ asset($learningAsset($lesson->image_path)) }}" alt="{{ $lesson->title }}">
        @endif
    </div>

    <div class="learn-detail-overlay"></div>

    <div class="learn-detail-hero-content">
        <a class="learn-back-link" href="{{ route('learn.index') }}">← Back to Learning Gallery</a>

        <span class="eyebrow">{{ $lesson->category ?: 'BTS Learning' }}</span>

        <h1>{{ $lesson->title }}</h1>

        @if(!empty($lesson->excerpt))
            <p>{{ $lesson->excerpt }}</p>
        @endif

        <div class="learn-detail-pills">
            @if(!empty($lesson->topic_type))
                <span>{{ $lesson->topic_type }}</span>
            @endif

            @if(!empty($lesson->difficulty))
                <span>{{ $lesson->difficulty }}</span>
            @endif

            <span>Story</span>
            <span>Media</span>
            <span>Official links</span>
        </div>
    </div>
</section>

<section class="learn-big-layout">
    <article class="learn-main-story">
        <div class="learn-section-title">
            <span class="eyebrow">Topic Guide</span>
            <h2>{{ $lesson->title }}</h2>
        </div>

        @if(!empty($lesson->body))
            <div class="learn-story-copy">
                {!! nl2br(e($lesson->body)) !!}
            </div>
        @else
            <p>
                This learning topic is being prepared with verified BTS information and official source links.
            </p>
        @endif
    </article>

    <aside class="learn-side-panel">
        <h3>Topic details</h3>

        <ul>
            <li><strong>Category:</strong> {{ $lesson->category ?: 'BTS Learning' }}</li>
            <li><strong>Type:</strong> {{ $lesson->topic_type ?: 'Guide' }}</li>
            <li><strong>Level:</strong> {{ $lesson->difficulty ?: 'Beginner' }}</li>

            @if(!empty($lesson->source_label))
                <li><strong>Source:</strong> {{ $lesson->source_label }}</li>
            @endif
        </ul>

        <p>
            TYSM :) FOR VISITING THIS LEARNING TOPIC! 💜
        </p>
    </aside>
</section>

@if($galleryImages->count())
    <section class="learn-media-section">
        <div class="learn-section-title center">
            <span class="eyebrow">Image Gallery</span>
            <h2>Visual moments</h2>
            <p>Photos connected to this learning topic.</p>
        </div>

        <div class="learn-gallery-grid">
            @foreach($galleryImages as $image)
                @php
                    $imagePath = $learningAsset($image);
                @endphp

                @if($imagePath)
                    <div class="learn-gallery-card">
                        <img src="{{ asset($imagePath) }}" alt="{{ $lesson->title }} image {{ $loop->iteration }}">
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif

@if($youtubeEmbed || !empty($videoPoster))
    <section class="learn-video-zone">
        <div class="learn-video-card">
            @if($youtubeEmbed)
                <iframe
                    src="{{ $youtubeEmbed }}"
                    title="{{ $lesson->title }} official video"
                    allowfullscreen
                    loading="lazy"
                    style="width:100%; min-height:420px; border:0;"
                ></iframe>
            @elseif(!empty($videoPoster))
                <img src="{{ asset($learningAsset($videoPoster)) }}" alt="{{ $lesson->title }} video poster">
            @endif

            <div class="learn-video-content">
                <span class="eyebrow">Watch Next</span>
                <h2>Official video section</h2>

                <p>
                    Use the official video or source link to continue learning about this topic.
                </p>

                @if(!empty($lesson->youtube_url))
                    <a class="btn primary" href="{{ $lesson->youtube_url }}" target="_blank" rel="noopener">
                        Open official video
                    </a>
                @endif
            </div>
        </div>
    </section>
@endif

@if($funFacts->count() || $historyNotes->count())
    <section class="learn-info-grid">
        @if($funFacts->count())
            <div class="learn-info-box">
                <h2>Fun facts</h2>

                @foreach($funFacts as $fact)
                    <p>✦ {{ $fact }}</p>
                @endforeach
            </div>
        @endif

        @if($historyNotes->count())
            <div class="learn-info-box">
                <h2>History notes</h2>

                @foreach($historyNotes as $note)
                    <p>✦ {{ $note }}</p>
                @endforeach
            </div>
        @endif
    </section>
@endif

@if($officialLinks->count())
    <section class="learn-links-panel">
        <div>
            <span class="eyebrow">Official Content</span>
            <h2>Useful links</h2>
            <p>Official and trusted links connected to this topic.</p>
        </div>

        <div class="learn-official-links">
            @foreach($officialLinks as $link)
                <a href="{{ $link['url'] }}" target="_blank" rel="noopener">
                    {{ $link['label'] ?? 'Open link' }} →
                </a>
            @endforeach
        </div>
    </section>
@endif
@endsection
