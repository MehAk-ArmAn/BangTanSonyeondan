@extends('layouts.admin.app')

@section('title', 'Latest Updates · BTS Admin')
@section('page_heading', 'Latest BTS Updates')

@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Latest board</p>
            <h2>Create BTS Update Post</h2>
        </div>
        <span class="admin-chip">Tiny post + full page</span>
    </div>

    <form method="POST" action="{{ route('admin.updates.store') }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form">
        @csrf

        <label>Title
            <input name="title" required placeholder="BTS official teaser dropped">
        </label>

        <label>Slug
            <input name="slug" placeholder="auto if blank">
        </label>

        <label>Category
            <input name="category" placeholder="Official / MV / Member / Weverse / Event">
        </label>

        <label>Source Label
            <input name="source_label" placeholder="BANGTANTV / Weverse / Official BTS">
        </label>

        <label>Image Path
            <input name="image_path" placeholder="imgs/updates/example.jpg">
        </label>

        <label>Upload Image
            <input type="file" name="image_file" accept="image/*">
        </label>

        <label>Video / YouTube URL
            <input type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=...">
        </label>

        <label>Upload Video
            <input type="file" name="video_file" accept="video/mp4,video/webm,video/quicktime">
        </label>

        <label>Published At
            <input type="datetime-local" name="published_at">
        </label>

        <label>Sort Order
            <input type="number" name="sort_order" value="0" min="0">
        </label>

        <label class="span-2">Short Teaser
            <textarea name="excerpt" maxlength="700" placeholder="Tiny update preview shown on the update card..."></textarea>
        </label>

        <label class="span-2">Full Update Body
            <textarea name="body" class="tall-textarea" placeholder="Write paragraphs here. Add context, explanation, ARMY note, official source details, etc."></textarea>
        </label>

        <label class="span-2">Links
            <textarea name="links_text" placeholder="One per line: Label | URL | Type&#10;Official MV | https://youtube.com/... | YouTube&#10;Weverse post | https://weverse.io/... | Official"></textarea>
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_pinned" value="1"> Pinned
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_featured" value="1"> Featured
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_active" value="1" checked> Published / Visible
        </label>

        <button class="span-2">Publish Update</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Manage posts</p>
            <h2>Latest Updates</h2>
        </div>
        <span class="admin-chip">{{ $updates->count() }} posts</span>
    </div>

    <div class="admin-accordion-list">
        @foreach($updates as $update)
            @php
                $linksText = collect($update->links ?? [])->map(fn($link) => ($link['label'] ?? '') . ' | ' . ($link['url'] ?? '') . ' | ' . ($link['type'] ?? ''))->implode("\n");
            @endphp

            <details class="admin-details professional-details">
                <summary>
                    <span>{{ $update->title }}</span>
                    <small>
                        {{ $update->category ?: 'Update' }}
                        · {{ $update->is_active ? 'Visible' : 'Hidden' }}
                        @if($update->is_pinned) · Pinned @endif
                    </small>
                </summary>

                <form method="POST" action="{{ route('admin.updates.update', $update) }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form inside-details">
                    @csrf
                    @method('PUT')

                    <label>Title
                        <input name="title" value="{{ $update->title }}" required>
                    </label>

                    <label>Slug
                        <input name="slug" value="{{ $update->slug }}">
                    </label>

                    <label>Category
                        <input name="category" value="{{ $update->category }}">
                    </label>

                    <label>Source Label
                        <input name="source_label" value="{{ $update->source_label }}">
                    </label>

                    <label>Image Path
                        <input name="image_path" value="{{ $update->image_path }}">
                    </label>

                    <label>Upload New Image
                        <input type="file" name="image_file" accept="image/*">
                    </label>

                    <label>Video / YouTube URL
                        <input type="url" name="video_url" value="{{ $update->video_url }}">
                    </label>

                    <label>Upload New Video
                        <input type="file" name="video_file" accept="video/mp4,video/webm,video/quicktime">
                    </label>

                    <label>Published At
                        <input type="datetime-local" name="published_at" value="{{ optional($update->published_at)->format('Y-m-d\TH:i') }}">
                    </label>

                    <label>Sort Order
                        <input type="number" name="sort_order" value="{{ $update->sort_order }}" min="0">
                    </label>

                    <label class="span-2">Short Teaser
                        <textarea name="excerpt" maxlength="700">{{ $update->excerpt }}</textarea>
                    </label>

                    <label class="span-2">Full Update Body
                        <textarea name="body" class="tall-textarea">{{ $update->body }}</textarea>
                    </label>

                    <label class="span-2">Links
                        <textarea name="links_text">{{ $linksText }}</textarea>
                    </label>

                    <label class="check-row">
                        <input type="checkbox" name="is_pinned" value="1" {{ $update->is_pinned ? 'checked' : '' }}> Pinned
                    </label>

                    <label class="check-row">
                        <input type="checkbox" name="is_featured" value="1" {{ $update->is_featured ? 'checked' : '' }}> Featured
                    </label>

                    <label class="check-row">
                        <input type="checkbox" name="is_active" value="1" {{ $update->is_active ? 'checked' : '' }}> Published / Visible
                    </label>

                    <div class="span-2 admin-update-preview-row">
                        @if($update->image_path)
                            <img src="{{ asset($update->image_path) }}" alt="{{ $update->title }}">
                        @endif

                        <a href="{{ route('updates.show', $update) }}" target="_blank">Open public post ↗</a>
                    </div>

                    <button class="span-2">Save Update</button>
                </form>

                <form method="POST" action="{{ route('admin.updates.destroy', $update) }}" onsubmit="return confirm('Delete this update post?')" class="inside-details">
                    @csrf
                    @method('DELETE')
                    <button class="danger">Delete Update</button>
                </form>
            </details>
        @endforeach
    </div>
</section>
@endsection