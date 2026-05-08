@extends('layouts.admin.app')
@section('title', 'BT21 · BTS Admin')
@section('page_heading', 'BT21 Anatomy Profiles')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Characters</p><h2>Add BT21 Character</h2></div></div>
    <form method="POST" action="{{ route('admin.bt21.store') }}" enctype="multipart/form-data" class="admin-grid-form">
        @csrf
        <label>Name<input name="name" placeholder="KOYA" required></label>
        <label>Slug<input name="slug" placeholder="koya"></label>
        <label>Member Name<input name="member_name" placeholder="RM"></label>
        <label>Emoji<input name="emoji" placeholder="🐨"></label>
        <label>Image Path<input name="image" placeholder="favicons/KOYA.png"></label>
        <label>Upload Image<input type="file" name="image_file" accept="image/*"></label>
        <label>Accent Color<input name="accent_color" value="#a855f7"></label>
        <label>Order<input type="number" name="sort_order" value="0"></label>
        <label class="span-2">Mood<textarea name="mood"></textarea></label>
        <label class="span-2">Power<textarea name="power"></textarea></label>
        <label class="span-2">Anatomy Notes - one per line<textarea name="anatomy_text"></textarea></label>
        <label class="span-2">Moves - one per line<textarea name="moves_text"></textarea></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        <button class="span-2">Add BT21 Character</button>
    </form>
</section>

@foreach($bt21List as $character)
<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">/bt21#{{ $character->slug }}</p><h2>{{ $character->emoji }} {{ $character->name }}</h2></div><span class="admin-chip">{{ $character->member_name }}</span></div>
    <form method="POST" action="{{ route('admin.bt21.update', $character) }}" enctype="multipart/form-data" class="admin-grid-form">
        @csrf @method('PUT')
        <label>Name<input name="name" value="{{ $character->name }}" required></label>
        <label>Slug<input name="slug" value="{{ $character->slug }}"></label>
        <label>Member Name<input name="member_name" value="{{ $character->member_name }}"></label>
        <label>Emoji<input name="emoji" value="{{ $character->emoji }}"></label>
        <label>Image Path<input name="image" value="{{ $character->image }}"></label>
        <label>Upload New Image<input type="file" name="image_file" accept="image/*"></label>
        <label>Accent Color<input name="accent_color" value="{{ $character->accent_color }}"></label>
        <label>Order<input type="number" name="sort_order" value="{{ $character->sort_order }}"></label>
        <label class="span-2">Mood<textarea name="mood">{{ $character->mood }}</textarea></label>
        <label class="span-2">Power<textarea name="power">{{ $character->power }}</textarea></label>
        <label class="span-2">Anatomy Notes<textarea name="anatomy_text">{{ implode("\n", $character->anatomy ?? []) }}</textarea></label>
        <label class="span-2">Moves<textarea name="moves_text">{{ implode("\n", $character->moves ?? []) }}</textarea></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $character->is_active ? 'checked' : '' }}> Active</label>
        <button class="span-2">Save BT21 Character</button>
    </form>
    <form method="POST" action="{{ route('admin.bt21.destroy', $character) }}" onsubmit="return confirm('Delete BT21 character?')">@csrf @method('DELETE')<button class="danger">Delete BT21 Character</button></form>
</section>
@endforeach
@endsection
