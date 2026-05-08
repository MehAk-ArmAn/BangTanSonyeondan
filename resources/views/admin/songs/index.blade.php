@extends('layouts.admin.app')
@section('title', 'Songs · BTS Admin')
@section('page_heading', 'Music Universe')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Songs library</p><h2>Add Song</h2></div></div>
    <form method="POST" action="{{ route('admin.songs.store') }}" enctype="multipart/form-data" class="admin-grid-form">
        @csrf
        <label>Song Title<input name="name" required></label>
        <label>Cover Image Path<input name="image" placeholder="imgs/songs/spring-day.jfif"></label>
        <label>Upload Cover<input type="file" name="image_file" accept="image/*"></label>
        <label>Release Date<input type="date" name="release_date"></label>
        <label>BTS Era / Album Era<input name="era"></label>
        <label>Display Priority<input type="number" name="sort_order" value="0"></label>
        <label class="span-2">Song Description<textarea name="description"></textarea></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Visible To ARMY</label>
        <button class="span-2">Add To BTS Library</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Edit existing</p><h2>Songs</h2></div></div>
    <div class="admin-accordion-list">
    @foreach($songsList as $song)
        <details class="admin-details professional-details">
            <summary><span>{{ $song->name }}</span><small>{{ $song->era }} · {{ $song->release_date }}</small></summary>
            <form method="POST" action="{{ route('admin.songs.update', $song) }}" enctype="multipart/form-data" class="admin-grid-form inside-details">
                @csrf @method('PUT')
                <label>Song Title<input name="name" value="{{ $song->name }}" required></label>
                <label>Cover Image Path<input name="image" value="{{ $song->image }}"></label>
                <label>Upload New Cover<input type="file" name="image_file" accept="image/*"></label>
                <label>Release Date<input type="date" name="release_date" value="{{ optional($song->release_date)->format('Y-m-d') }}"></label>
                <label>BTS Era / Album Era<input name="era" value="{{ $song->era }}"></label>
                <label>Display Priority<input type="number" name="sort_order" value="{{ $song->sort_order }}"></label>
                <label class="span-2">Song Description<textarea name="description">{{ $song->description }}</textarea></label>
                <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $song->is_active ? 'checked' : '' }}> Visible To ARMY</label>
                <button class="span-2">Save Song</button>
            </form>
            <form method="POST" action="{{ route('admin.songs.destroy', $song) }}" onsubmit="return confirm('Delete this song?')" class="inside-details">@csrf @method('DELETE')<button class="danger">Delete Song</button></form>
        </details>
    @endforeach
    </div>
</section>
@endsection
