@extends('layouts.admin.app')
@section('title', 'Learning Materials · BTS Admin')
@section('page_heading', 'Learning Gallery')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Learning gallery</p>
            <h2>Add BTS Learning Material</h2>
        </div>
        <span class="admin-chip">Separate from quizzes</span>
    </div>

    <form method="POST" action="{{ route('admin.learning-materials.store') }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form">
        @csrf
        <label>Title<input name="title" required placeholder="MV Study: Spring Day"></label>
        <label>Slug<input name="slug" placeholder="auto if blank"></label>
        <label>Category<input name="category" value="BTS 101" required placeholder="BTS 101 / Music Videos / Members"></label>
        <label>Topic Type<input name="topic_type" value="Guide" required placeholder="Guide / MV Study / Glossary"></label>
        <label>Difficulty<input name="difficulty" placeholder="Beginner / Intermediate / Advanced"></label>
        <label>Sort Order<input type="number" name="sort_order" value="0" min="0"></label>
        <label class="span-2">Short Excerpt<textarea name="excerpt" maxlength="600" placeholder="Short preview shown on the gallery card"></textarea></label>
        <label class="span-2">Learning Body<textarea name="body" class="tall-textarea" placeholder="Write the actual learning content here..."></textarea></label>
        <label>Image Path<input name="image_path" placeholder="imgs/songs/dynamite.jfif"></label>
        <label>Upload Image<input type="file" name="image_file" accept="image/*"></label>
        <label>Official URL<input type="url" name="official_url" placeholder="https://ibighit.com/bts/eng/"></label>
        <label>YouTube / MV URL<input type="url" name="youtube_url" placeholder="https://www.youtube.com/watch?v=..."></label>
        <label class="span-2">Source Label<input name="source_label" placeholder="Official BTS site / Official MV / BANGTANTV"></label>
        <label class="span-2">Extra Links<textarea name="links_text" placeholder="One per line: Label | URL | Type&#10;BANGTANTV | https://www.youtube.com/@BTS | Official YouTube"></textarea></label>
        <label class="check-row"><input type="checkbox" name="is_featured" value="1"> Featured card</label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Visible</label>
        <button class="span-2">Add Learning Material</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Manage existing</p>
            <h2>Learning Materials</h2>
        </div>
        <span class="admin-chip">{{ $materials->count() }} items</span>
    </div>

    <div class="admin-accordion-list">
        @foreach($materials as $material)
            @php
                $linksText = collect($material->links ?? [])->map(fn($link) => ($link['label'] ?? '') . ' | ' . ($link['url'] ?? '') . ' | ' . ($link['type'] ?? ''))->implode("\n");
            @endphp
            <details class="admin-details professional-details">
                <summary>
                    <span>{{ $material->title }}</span>
                    <small>{{ $material->category }} · {{ $material->topic_type }} · {{ $material->is_active ? 'Visible' : 'Hidden' }}</small>
                </summary>

                <form method="POST" action="{{ route('admin.learning-materials.update', $material) }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form inside-details">
                    @csrf @method('PUT')
                    <label>Title<input name="title" value="{{ $material->title }}" required></label>
                    <label>Slug<input name="slug" value="{{ $material->slug }}"></label>
                    <label>Category<input name="category" value="{{ $material->category }}" required></label>
                    <label>Topic Type<input name="topic_type" value="{{ $material->topic_type }}" required></label>
                    <label>Difficulty<input name="difficulty" value="{{ $material->difficulty }}"></label>
                    <label>Sort Order<input type="number" name="sort_order" value="{{ $material->sort_order }}" min="0"></label>
                    <label class="span-2">Short Excerpt<textarea name="excerpt" maxlength="600">{{ $material->excerpt }}</textarea></label>
                    <label class="span-2">Learning Body<textarea name="body" class="tall-textarea">{{ $material->body }}</textarea></label>
                    <label>Image Path<input name="image_path" value="{{ $material->image_path }}"></label>
                    <label>Upload New Image<input type="file" name="image_file" accept="image/*"></label>
                    <label>Official URL<input type="url" name="official_url" value="{{ $material->official_url }}"></label>
                    <label>YouTube / MV URL<input type="url" name="youtube_url" value="{{ $material->youtube_url }}"></label>
                    <label class="span-2">Source Label<input name="source_label" value="{{ $material->source_label }}"></label>
                    <label class="span-2">Extra Links<textarea name="links_text">{{ $linksText }}</textarea></label>
                    <label class="check-row"><input type="checkbox" name="is_featured" value="1" {{ $material->is_featured ? 'checked' : '' }}> Featured card</label>
                    <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $material->is_active ? 'checked' : '' }}> Visible</label>
                    <button class="span-2">Save Learning Material</button>
                </form>

                <form method="POST" action="{{ route('admin.learning-materials.destroy', $material) }}" onsubmit="return confirm('Delete this learning material?')" class="inside-details">
                    @csrf @method('DELETE')
                    <button class="danger">Delete Learning Material</button>
                </form>
            </details>
        @endforeach
    </div>
</section>
@endsection
