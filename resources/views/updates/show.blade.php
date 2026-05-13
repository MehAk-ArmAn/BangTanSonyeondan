@extends('layouts.frontend.app')

@section('title', $update->title . ' · Latest BTS Update')

@section('content')
<section class="update-show-hero">
    <div class="update-show-copy">
        <a class="learn-back-link" href="{{ route('updates.index') }}">← Back to Latest Updates</a>

        <span class="eyebrow">{{ $update->category ?: 'Latest Update' }}</span>
        <h1>{{ $update->title }}</h1>

        <p>{{ $update->excerpt ?: 'A BangTanSonyeondan update for ARMY.' }}</p>

        <div class="dashboard-badge-row">
            @if($update->is_pinned)<span>Pinned</span>@endif
            @if($update->is_featured)<span>Featured</span>@endif
            <span>{{ optional($update->published_at)->format('M d, Y h:i A') ?: $update->created_at->format('M d, Y h:i A') }}</span>
            @if($update->source_label)<span>{{ $update->source_label }}</span>@endif
        </div>

        <div class="hero-actions">
            <button
                type="button"
                class="btn primary js-share-update"
                data-share-url="{{ route('updates.show', $update) }}"
                data-share-title="{{ $update->title }}"
            >
                Share update
            </button>

            @if($update->video_url)
                <a class="btn ghost" href="{{ $update->video_url }}" target="_blank" rel="noopener">Open video</a>
            @endif
        </div>
    </div>

    <div class="update-show-media">
        @if($update->image_path)
            <img src="{{ asset($update->image_path) }}" alt="{{ $update->title }}">
        @else
            <div class="update-card-fallback">BTS</div>
        @endif
    </div>
</section>

@if($update->youtubeEmbedUrl() || $update->video_path)
    <section class="update-video-section">
        <div class="update-video-frame">
            @if($update->youtubeEmbedUrl())
                <iframe
                    src="{{ $update->youtubeEmbedUrl() }}"
                    title="{{ $update->title }}"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            @else
                <video controls preload="metadata">
                    <source src="{{ asset($update->video_path) }}">
                    Your browser does not support the video tag.
                </video>
            @endif
        </div>
    </section>
@endif

<section class="update-content-layout">
    <article class="update-main-body">
        {!! nl2br(e($update->body ?: 'Full details for this update will be added soon.')) !!}
    </article>

    <aside class="update-side-panel">
        <h2>Useful links</h2>

        <div class="official-link-stack">
            @forelse($update->links ?? [] as $link)
                <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener">
                    {{ $link['label'] ?? 'Open link' }}
                    <span>{{ $link['type'] ?? 'Source' }}</span>
                </a>
            @empty
                <p>No extra links added yet.</p>
            @endforelse
        </div>
    </aside>
</section>

@if($related->count())
    <section class="section-block">
        <div class="section-heading">
            <span class="eyebrow">More updates</span>
            <h2>Related posts</h2>
        </div>

        <div class="updates-grid compact-updates-grid">
            @foreach($related as $item)
                <a class="related-update-card" href="{{ route('updates.show', $item) }}">
                    <span>{{ $item->category ?: 'Update' }}</span>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($item->body), 110) }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endif
@endsection
