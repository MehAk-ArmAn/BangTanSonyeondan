{{-- Dynamic timeline page. --}}
@extends('layouts.frontend.app')
@section('title', 'Timeline Â· BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">Timeline Vault</span>
    <h1>BTS Milestones</h1>
    <p>Database-driven timeline highlights. Add/edit events from admin instead of hardcoding forever.</p>
</section>
<section class="timeline-page">
    @foreach($events as $event)
        <article class="timeline-card">
            <div class="timeline-year">{{ $event->year }}</div>
            <div class="timeline-body">
                <span>{{ $event->category }}</span>
                <h2>{{ $event->title }}</h2>
                <p>{{ $event->body }}</p>
                @if(!empty($event->bullet_points))
                    <ul class="pretty-list">@foreach($event->bullet_points as $point)<li>{{ $point }}</li>@endforeach</ul>
                @endif
                @if(!empty($event->image_paths))
                    <div class="timeline-images">
                        @foreach($event->image_paths as $path)<img src="{{ asset($path) }}" alt="{{ $event->title }}">@endforeach
                    </div>
                @endif
            </div>
        </article>
    @endforeach
</section>
@endsection

