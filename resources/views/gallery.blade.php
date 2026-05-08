@extends('layouts.frontend.app')
@section('title', 'Gallery · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Photo Vault</span>
    <h1>Gallery</h1>
    <p>Dark purple masonry gallery for eras, memes, member moments, and soft ARMY chaos.</p>
</section>

<section class="filter-pills">
    <span>All</span><span>Group</span><span>Members</span><span>Era</span><span>Meme</span>
</section>

<section class="masonry-gallery">
    @foreach($images as $image)
        <article class="gallery-card">
            <img src="{{ asset($image->img_path) }}" alt="{{ $image->name }}">
            <div>
                <span>{{ $image->category ?? 'Gallery' }}</span>
                <h3>{{ $image->name }}</h3>
                <p>{{ $image->caption }}</p>
            </div>
        </article>
    @endforeach
</section>
@endsection
