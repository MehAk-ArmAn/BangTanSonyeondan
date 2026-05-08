@extends('layouts.frontend.app')
@section('title', 'BTS Achievements · BangTanSonyeondan')
@section('content')
<section class="hero-banner achievement-hero">
    <img src="{{ asset('imgs/bts.jfif') }}" alt="BTS hero image">
    <div class="hero-text">
        <span class="eyebrow">Old Project Hero Restored</span>
        <h1>BTS — Timeline of Achievements & Awards</h1>
        <p>The iconic old hero is back, but the timeline is now database-driven from Laravel.</p>
    </div>
</section>

<section class="timeline-container legacy-timeline">
    @foreach($events as $index => $event)
        <article class="timeline-item {{ $index % 2 === 0 ? 'left' : 'right' }}" id="timeline-{{ $event->id }}">
            <div class="timeline-date">{{ $event->year }}</div>
            <div class="timeline-content">
                <span>{{ $event->category }}</span>
                <h2>{{ $event->title }}</h2>
                <p>{{ $event->body }}</p>
                @if(!empty($event->bullet_points))
                    <ul>
                        @foreach($event->bullet_points as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                @endif
                @if(!empty($event->image_paths))
                    <div class="legacy-timeline-images">
                        @foreach($event->image_paths as $path)
                            <img src="{{ asset($path) }}" alt="{{ $event->title }}">
                        @endforeach
                    </div>
                @endif
            </div>
        </article>
    @endforeach
</section>
@endsection
