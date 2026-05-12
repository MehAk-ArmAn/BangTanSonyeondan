@extends('layouts.frontend.app')

@section('title', 'Latest BTS Updates · BangTanSonyeondan')

@section('content')
<section class="updates-hero">
    <div>
        <span class="eyebrow">Latest BTS Updates</span>
        <h1>Fresh updates, tiny posts, links, clips, and ARMY notes.</h1>
        <p>
            A live-style update wall managed from admin. Add quick posts, official links,
            images, videos, short notes, and full update pages whenever something new drops.
        </p>
    </div>

    <div class="updates-live-card">
        <span>Live Board</span>
        <b>{{ $updates->total() }}</b>
        <small>published updates</small>
    </div>
</section>

<form class="updates-filter-card" method="GET" action="{{ route('updates.index') }}">
    <input type="search" name="q" value="{{ $query }}" placeholder="Search updates, eras, MVs, members...">

    <select name="category">
        <option value="">All categories</option>
        @foreach($categories as $item)
            <option value="{{ $item }}" {{ $category === $item ? 'selected' : '' }}>{{ $item }}</option>
        @endforeach
    </select>

    <button type="submit">Search</button>
</form>

<section class="updates-grid">
    @forelse($updates as $update)
        <article class="update-card {{ $update->is_featured ? 'is-featured' : '' }}">
            <a class="update-card-media" href="{{ route('updates.show', $update) }}">
                @if($update->image_path)
                    <img src="{{ asset($update->image_path) }}" alt="{{ $update->title }}">
                @else
                    <div class="update-card-fallback">BTS</div>
                @endif

                @if($update->is_pinned)
                    <span class="update-pin">Pinned</span>
                @endif
            </a>

            <div class="update-card-body">
                <div class="update-meta-row">
                    <span>{{ $update->category ?: 'Update' }}</span>
                    <small>{{ optional($update->published_at)->format('M d, Y') ?: $update->created_at->format('M d, Y') }}</small>
                </div>

                <h2>
                    <a href="{{ route('updates.show', $update) }}">{{ $update->title }}</a>
                </h2>

                <p>{{ $update->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($update->body), 150) }}</p>

                <div class="update-action-row">
                    <a href="{{ route('updates.show', $update) }}">Read update →</a>

                    @if($update->source_label)
                        <span>{{ $update->source_label }}</span>
                    @endif
                </div>
            </div>
        </article>
    @empty
        <div class="glass-panel profile-empty-state">
            <h2>No updates yet.</h2>
            <p>Go to admin and publish your first BTS update post.</p>
        </div>
    @endforelse
</section>

<div class="public-pagination">
    {{ $updates->links() }}
</div>
@endsection