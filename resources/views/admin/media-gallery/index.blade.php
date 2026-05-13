@extends('layouts.admin.app')

@section('title', 'Media Gallery · Admin')
@section('page_heading', 'Media Gallery')

@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Phone-style gallery</p>
            <h2>Create Album / Folder</h2>
        </div>
        <span class="admin-chip">{{ $albums->count() }} albums</span>
    </div>

    <form method="POST" action="{{ route('admin.media-gallery.albums.store') }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form">
        @csrf

        <label>Album Title
            <input name="title" required placeholder="Dynamite Era">
        </label>

        <label>Slug
            <input name="slug" placeholder="auto if blank">
        </label>

        <label class="span-2">Description
            <textarea name="description" placeholder="Small album description..."></textarea>
        </label>

        <label>Cover Path
            <input name="cover_path" placeholder="imgs/gallery/dynamite-cover.jpg">
        </label>

        <label>Upload Cover
            <input type="file" name="cover_file" accept="image/*">
        </label>

        <label>Sort Order
            <input type="number" name="sort_order" value="0" min="0">
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_featured" value="1"> Featured
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_active" value="1" checked> Active
        </label>

        <button class="span-2">Create Album</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Add media</p>
            <h2>Add Photo / Video</h2>
        </div>
        <span class="admin-chip">{{ $items->count() }} recent items</span>
    </div>

    <form method="POST" action="{{ route('admin.media-gallery.items.store') }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form">
        @csrf

        <label>Album
            <select name="media_album_id">
                <option value="">Unsorted</option>
                @foreach($albums as $album)
                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                @endforeach
            </select>
        </label>

        <label>Media Type
            <select name="media_type" required>
                <option value="image">Image</option>
                <option value="video">Uploaded Video</option>
                <option value="youtube">YouTube Video</option>
            </select>
        </label>

        <label>Title
            <input name="title" required placeholder="Jungkook stage moment">
        </label>

        <label>Tags
            <input name="tags" placeholder="jungkook, concert, stage, 2024">
        </label>

        <label class="span-2">Caption
            <textarea name="caption" placeholder="Write a cute caption..."></textarea>
        </label>

        <label>File Path
            <input name="file_path" placeholder="imgs/gallery/example.jpg or storage/...">
        </label>

        <label>Upload Image / Video
            <input type="file" name="media_file" accept="image/*,video/mp4,video/webm,video/quicktime">
        </label>

        <label>Thumbnail Path
            <input name="thumbnail_path" placeholder="imgs/gallery/thumb.jpg">
        </label>

        <label>Upload Thumbnail
            <input type="file" name="thumbnail_file" accept="image/*">
        </label>

        <label class="span-2">YouTube / Video URL
            <input type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=...">
        </label>

        <label>Taken At
            <input type="datetime-local" name="taken_at">
        </label>

        <label>Sort Order
            <input type="number" name="sort_order" value="0" min="0">
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_featured" value="1"> Featured
        </label>

        <label class="check-row">
            <input type="checkbox" name="is_active" value="1" checked> Active
        </label>

        <button class="span-2">Add Media</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Manage albums</p>
            <h2>Albums / Folders</h2>
        </div>
    </div>

    @foreach($albums as $album)
        <details class="admin-details professional-details">
            <summary>
                <span>{{ $album->title }}</span>
                <small>{{ $album->items->count() }} items · {{ $album->is_active ? 'Active' : 'Hidden' }}</small>
            </summary>

            <form method="POST" action="{{ route('admin.media-gallery.albums.update', $album) }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form inside-details">
                @csrf
                @method('PUT')

                <label>Album Title
                    <input name="title" value="{{ $album->title }}" required>
                </label>

                <label>Slug
                    <input name="slug" value="{{ $album->slug }}">
                </label>

                <label class="span-2">Description
                    <textarea name="description">{{ $album->description }}</textarea>
                </label>

                <label>Cover Path
                    <input name="cover_path" value="{{ $album->cover_path }}">
                </label>

                <label>Upload New Cover
                    <input type="file" name="cover_file" accept="image/*">
                </label>

                <label>Sort Order
                    <input type="number" name="sort_order" value="{{ $album->sort_order }}" min="0">
                </label>

                <label class="check-row">
                    <input type="checkbox" name="is_featured" value="1" {{ $album->is_featured ? 'checked' : '' }}> Featured
                </label>

                <label class="check-row">
                    <input type="checkbox" name="is_active" value="1" {{ $album->is_active ? 'checked' : '' }}> Active
                </label>

                <button class="span-2">Save Album</button>
            </form>

            <form method="POST" action="{{ route('admin.media-gallery.albums.destroy', $album) }}" class="inside-details" onsubmit="return confirm('Delete this album? Items will become unsorted.')">
                @csrf
                @method('DELETE')
                <button class="danger">Delete Album</button>
            </form>
        </details>
    @endforeach
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Manage media</p>
            <h2>Recent Media Items</h2>
        </div>
    </div>

    @foreach($items as $item)
        <details class="admin-details professional-details">
            <summary>
                <span>{{ $item->title }}</span>
                <small>{{ strtoupper($item->media_type) }} · {{ optional($item->album)->title ?: 'Unsorted' }} · {{ $item->is_active ? 'Active' : 'Hidden' }}</small>
            </summary>

            <form method="POST" action="{{ route('admin.media-gallery.items.update', $item) }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form inside-details">
                @csrf
                @method('PUT')

                <label>Album
                    <select name="media_album_id">
                        <option value="">Unsorted</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}" {{ $item->media_album_id === $album->id ? 'selected' : '' }}>
                                {{ $album->title }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label>Media Type
                    <select name="media_type" required>
                        <option value="image" {{ $item->media_type === 'image' ? 'selected' : '' }}>Image</option>
                        <option value="video" {{ $item->media_type === 'video' ? 'selected' : '' }}>Uploaded Video</option>
                        <option value="youtube" {{ $item->media_type === 'youtube' ? 'selected' : '' }}>YouTube Video</option>
                    </select>
                </label>

                <label>Title
                    <input name="title" value="{{ $item->title }}" required>
                </label>

                <label>Tags
                    <input name="tags" value="{{ $item->tags }}">
                </label>

                <label class="span-2">Caption
                    <textarea name="caption">{{ $item->caption }}</textarea>
                </label>

                <label>File Path
                    <input name="file_path" value="{{ $item->file_path }}">
                </label>

                <label>Upload New File
                    <input type="file" name="media_file" accept="image/*,video/mp4,video/webm,video/quicktime">
                </label>

                <label>Thumbnail Path
                    <input name="thumbnail_path" value="{{ $item->thumbnail_path }}">
                </label>

                <label>Upload New Thumbnail
                    <input type="file" name="thumbnail_file" accept="image/*">
                </label>

                <label class="span-2">YouTube / Video URL
                    <input type="url" name="video_url" value="{{ $item->video_url }}">
                </label>

                <label>Taken At
                    <input type="datetime-local" name="taken_at" value="{{ optional($item->taken_at)->format('Y-m-d\TH:i') }}">
                </label>

                <label>Sort Order
                    <input type="number" name="sort_order" value="{{ $item->sort_order }}" min="0">
                </label>

                <label class="check-row">
                    <input type="checkbox" name="is_featured" value="1" {{ $item->is_featured ? 'checked' : '' }}> Featured
                </label>

                <label class="check-row">
                    <input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}> Active
                </label>

                <div class="span-2 admin-media-preview">
                    @if($item->thumbnailSrc())
                        <img src="{{ asset($item->thumbnailSrc()) }}" alt="{{ $item->title }}">
                    @endif

                    @if($item->displaySrc())
                        <a href="{{ $item->media_type === 'youtube' ? $item->video_url : asset($item->displaySrc()) }}" target="_blank">Open media ↗</a>
                    @endif
                </div>

                <button class="span-2">Save Media Item</button>
            </form>

            <form method="POST" action="{{ route('admin.media-gallery.items.destroy', $item) }}" class="inside-details" onsubmit="return confirm('Delete this media item?')">
                @csrf
                @method('DELETE')
                <button class="danger">Delete Media Item</button>
            </form>
        </details>
    @endforeach
</section>
@endsection
