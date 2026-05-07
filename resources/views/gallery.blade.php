{{-- Gallery page. --}}
@extends('layouts.frontend.app')
@section('title', 'Gallery · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Meme Museum + Moments</span>
    <h1>Gallery Wall</h1>
    <p>Admin-managed images grouped by vibe, era, members, memes, and purple chaos.</p>
</section>
@if($categories->isNotEmpty())
    <div class="filter-pills">
        @foreach($categories as $category)<span>{{ $category }}</span>@endforeach
    </div>
@endif
<div class="masonry-gallery">
    @foreach($pics as $pic)
        <article class="gallery-card">
            <img src="{{ asset($pic->img_path) }}" alt="{{ $pic->name }}">
            <div>
                <span>{{ $pic->category }}</span>
                <h3>{{ $pic->name }}</h3>
                @if($pic->caption)<p>{{ $pic->caption }}</p>@endif
            </div>
        </article>
    @endforeach
</div>
@endsection
