@extends('layouts.frontend.app')

@section('title', 'Gallery · BangTanSonyeondan')

@section('content')
<section class="phone-gallery-hero">
    <div>
        <span class="eyebrow">BTS Media Gallery</span>
        <h1>Albums, memories, videos, and purple moments.</h1>
        <p>
            Scroll like a phone gallery, open media in full-screen, use arrows,
            search memories, and browse by album.
        </p>
    </div>

    <div class="phone-gallery-stat">
        <span>Total media</span>
        <b>{{ $items->count() }}</b>
        <small>{{ $albums->count() }} albums</small>
    </div>
</section>

<form class="phone-gallery-search" method="GET" action="{{ route('gallery.index') }}">
    <input type="search" name="q" value="{{ $search }}" placeholder="Search photos, videos, tags, captions...">

    <select name="album">
        <option value="">All albums</option>
        @foreach($albums as $album)
            <option value="{{ $album->slug }}" {{ $albumSlug === $album->slug ? 'selected' : '' }}>
                {{ $album->title }}
            </option>
        @endforeach
    </select>

    <button type="submit">Search</button>
</form>

<section class="phone-albums-strip" aria-label="Albums">
    <a class="phone-album-pill {{ $albumSlug === '' ? 'is-active' : '' }}" href="{{ route('gallery.index', ['q' => $search]) }}">
        <span>All</span>
        <b>{{ $items->count() }}</b>
    </a>

    @foreach($albums as $album)
        <a class="phone-album-pill {{ $albumSlug === $album->slug ? 'is-active' : '' }}"
           href="{{ route('gallery.index', ['album' => $album->slug, 'q' => $search]) }}">
            @if($album->cover_path)
                <img src="{{ asset($album->cover_path) }}" alt="{{ $album->title }}">
            @endif
            <span>{{ $album->title }}</span>
            <b>{{ $album->items_count }}</b>
        </a>
    @endforeach
</section>

@if($selectedAlbum)
    <section class="phone-selected-album">
        <span class="eyebrow">Current album</span>
        <h2>{{ $selectedAlbum->title }}</h2>
        <p>{{ $selectedAlbum->description ?: 'Browse this BTS album.' }}</p>
    </section>
@endif

<section class="phone-gallery-grid" id="phoneGalleryGrid">
    @forelse($items as $index => $item)
        @php
            $thumb = $item->thumbnailSrc();
            $src = $item->displaySrc();
            $embed = $item->youtubeEmbedUrl();
            $mediaSrc = $embed ?: $src;
        @endphp

        <button
            type="button"
            class="phone-media-card {{ $item->media_type }}"
            data-gallery-item
            data-index="{{ $index }}"
            data-type="{{ $item->media_type }}"
            data-title="{{ e($item->title) }}"
            data-caption="{{ e($item->caption ?: '') }}"
            data-src="{{ $mediaSrc ? asset($mediaSrc) : '' }}"
            data-raw-src="{{ $mediaSrc ?: '' }}"
            data-album="{{ e(optional($item->album)->title ?: 'Unsorted') }}"
        >
            <div class="phone-media-thumb">
                @if($thumb)
                    <img src="{{ asset($thumb) }}" alt="{{ $item->title }}">
                @elseif($item->media_type === 'youtube')
                    <div class="phone-media-fallback">▶</div>
                @else
                    <div class="phone-media-fallback">BTS</div>
                @endif

                @if($item->media_type !== 'image')
                    <span class="media-type-badge">Video</span>
                @endif
            </div>

            <div class="phone-media-info">
                <strong>{{ $item->title }}</strong>
                <span>{{ optional($item->album)->title ?: 'Unsorted' }}</span>
            </div>
        </button>
    @empty
        <div class="glass-panel profile-empty-state">
            <h2>No media found.</h2>
            <p>Add photos or videos from the admin media gallery.</p>
        </div>
    @endforelse
</section>

<div class="phone-lightbox" id="phoneLightbox" aria-hidden="true">
    <button type="button" class="lightbox-close" id="lightboxClose" aria-label="Close">×</button>

    <button type="button" class="lightbox-arrow lightbox-prev" id="lightboxPrev" aria-label="Previous">‹</button>
    <button type="button" class="lightbox-arrow lightbox-next" id="lightboxNext" aria-label="Next">›</button>

    <div class="lightbox-stage" id="lightboxStage"></div>

    <div class="lightbox-caption">
        <span id="lightboxAlbum">Album</span>
        <h2 id="lightboxTitle">Title</h2>
        <p id="lightboxText"></p>
    </div>
</div>
@endsection
