@extends('layouts.frontend.app')

@section('title', 'BTS Learning Gallery · BangTanSonyeondan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/bts-learning-cinematic.css') }}">
@endpush

@section('content')
<section class="learn-cinema-hero">
    <div class="learn-hero-glow"></div>

    <span class="eyebrow">BTS Learning Gallery</span>
    <h1>Explore BTS by topic, era, music, members, history, MVs, and ARMY culture.</h1>
    <p>
        Pick a topic and open a full learning page filled with story sections, image spaces,
        video spaces, fun facts, history notes, and official links.
    </p>
</section>

<section class="learn-topic-grid">
    @foreach($materials as $lesson)
        <a class="learn-topic-card" href="{{ route('learn.show', $lesson->slug) }}">
            <div class="learn-topic-image">
                @if($lesson->image_path)
                    <img src="{{ asset($lesson->image_path) }}" alt="{{ $lesson->title }}">
                @else
                    <div class="learn-image-placeholder">
                        <span>Image space</span>
                        <small>public/imgs/learn/{{ $lesson->slug }}/cover.jpg</small>
                    </div>
                @endif
            </div>

            <div class="learn-topic-content">
                <span class="learn-category">{{ $lesson->category }}</span>
                <h2>{{ $lesson->title }}</h2>
                <p>{{ $lesson->excerpt }}</p>

                <div class="learn-card-footer">
                    <span>Open full topic</span>
                    <b>→</b>
                </div>
            </div>
        </a>
    @endforeach
</section>
@endsection
