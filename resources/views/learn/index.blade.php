@extends('layouts.frontend.app')
@section('title', 'Learn BTS · BangTanSonyeondan')
@section('content')
<section class="page-hero small">
    <span class="eyebrow">BTS Learning Library</span>
    <h1>Learn everything, then prove it in quizzes.</h1>
    <p>Each lesson teaches a BTS topic and includes quiz questions. Login to earn points.</p>
</section>

<div class="lesson-grid full">
    @foreach($lessons as $lesson)
        <a class="lesson-card large" href="{{ route('learn.show', $lesson->slug) }}">
            <span>{{ $lesson->category }}</span>
            <h2>{{ $lesson->title }}</h2>
            <p>{{ $lesson->excerpt }}</p>
            <small>{{ $lesson->reward_points }} possible points</small>
        </a>
    @endforeach
</div>
@endsection
