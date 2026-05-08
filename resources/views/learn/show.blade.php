@extends('layouts.frontend.app')
@section('title', $lesson->title . ' · BangTanSonyeondan')
@section('content')
<section class="lesson-hero">
    <div>
        <span class="eyebrow">{{ $lesson->category }}</span>
        <h1>{{ $lesson->title }}</h1>
        <p>{{ $lesson->excerpt }}</p>
        @if($bestAttempt)
            <div class="public-alert success">Best score: {{ $bestAttempt->score }}/{{ $bestAttempt->total }} · {{ $bestAttempt->points_earned }} points earned</div>
        @endif
    </div>
</section>

<section class="lesson-body glass-panel">
    {!! nl2br(e($lesson->body)) !!}
</section>

<section class="section-block">
    <div class="section-heading">
        <span class="eyebrow">Quiz Time</span>
        <h2>Test yourself.</h2>
        <p>Login first to submit answers and earn points.</p>
    </div>

    @auth
        <form method="POST" action="{{ route('learn.submit', $lesson) }}" class="quiz-form">
            @csrf
            @foreach($lesson->questions as $question)
                <article class="quiz-card">
                    <h3>{{ $loop->iteration }}. {{ $question->question }}</h3>
                    <div class="quiz-options">
                        @foreach($question->options as $index => $option)
                            <label>
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $index }}" required>
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                </article>
            @endforeach
            <button class="btn primary" type="submit">Submit quiz</button>
        </form>
    @else
        <div class="glass-panel">
            <h3>Create your account to earn points.</h3>
            <p>You can read the lesson without login, but points need a profile.</p>
            <div class="hero-actions">
                <a class="btn primary" href="{{ route('register') }}">Create account</a>
                <a class="btn ghost" href="{{ route('login') }}">Login</a>
            </div>
        </div>
    @endauth
</section>
@endsection
