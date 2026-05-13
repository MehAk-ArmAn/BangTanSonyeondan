@extends('layouts.admin.app')
@section('title', 'Gallery · BTS Admin')
@section('page_heading', 'Photo + Video Gallery')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Gallery</p><h2>Add Gallery Item</h2></div></div>
    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="admin-grid-form">
        @csrf
        <label>Title<input name="title" required></label>
        <label>Category<input name="category" placeholder="Photos / Videos / Stage"></label>
        <label>Image Path<input name="image" placeholder="imgs/gallery/example.jpg"></label>
        <label>Upload Image<input type="file" name="image_file" accept="image/*"></label>
        <label>Display Priority<input type="number" name="sort_order" value="0"></label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Visible</label>
        <label class="span-2">Caption<textarea name="caption"></textarea></label>
        <button class="span-2">Add Gallery Item</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header"><div><p class="admin-eyebrow">Edit existing</p><h2>Gallery Items</h2></div></div>
    <div class="professional-mini-grid">
        @foreach($galleryList as $item)
            <article class="professional-mini-card">
                @if($item->image)<img src="{{ asset($item->image) }}" alt="{{ $item->title }}">@endif
                <div class="mini-card-body">
                    <form method="POST" action="{{ route('admin.gallery.update', $item) }}" enctype="multipart/form-data" class="admin-grid-form compact-form">
                        @csrf @method('PUT')
                        <label>Title<input name="title" value="{{ $item->title }}" required></label>
                        <label>Category<input name="category" value="{{ $item->category }}"></label>
                        <label class="span-2">Image Path<input name="image" value="{{ $item->image }}"></label>
                        <label class="span-2">Upload New Image<input type="file" name="image_file" accept="image/*"></label>
                        <label>Order<input type="number" name="sort_order" value="{{ $item->sort_order }}"></label>
                        <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}> Visible</label>
                        <label class="span-2">Caption<textarea name="caption">{{ $item->caption }}</textarea></label>
                        <button class="span-2">Save</button>
                    </form>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Delete gallery item?')">@csrf @method('DELETE')<button class="danger">Delete</button></form>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
