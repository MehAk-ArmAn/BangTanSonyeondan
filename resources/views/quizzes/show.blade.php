@extends('layouts.frontend.app')
@section('title', $quiz->title . ' · Quiz Arena')
@section('content')
<section class="quiz-play-hero difficulty-{{ $quiz->difficulty }}">
    <div>
        <span class="eyebrow">{{ $quiz->category }} · {{ $quiz->levelLabel() }}</span>
        <h1>{{ $quiz->title }}</h1>
        <p>{{ $quiz->description }}</p>
        @if($bestAttempt)
            <div class="public-alert success">Best score: {{ $bestAttempt->score }}/{{ $bestAttempt->total }} · {{ $bestAttempt->points_earned }} points · {{ $bestAttempt->accuracy }}%</div>
        @endif
    </div>
    <div class="quiz-play-stats">
        <div><span>Questions</span><b>{{ $quiz->questions->count() }}</b></div>
        <div><span>Correct answer</span><b>+{{ number_format($quiz->points_per_question) }}</b></div>
        <div><span>Perfect bonus</span><b>+{{ number_format($quiz->bonus_points) }}</b></div>
    </div>
</section>

@if($quiz->questions->isEmpty())
    <section class="empty-state-card">This quiz has no active questions yet.</section>
@else
    @auth
        <form method="POST" action="{{ route('quizzes.submit', $quiz->slug) }}" class="blooket-quiz-form">
            @csrf
            @foreach($quiz->questions as $question)
                <article class="blooket-question-card">
                    <div class="question-number">{{ $loop->iteration }}</div>
                    <h2>{{ $question->question }}</h2>
                    <div class="blooket-option-grid">
                        @foreach($question->options as $index => $option)
                            <label class="blooket-option option-{{ $index % 4 }}">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $index }}" required>
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                </article>
            @endforeach
            <div class="quiz-submit-bar glass-panel">
                <div>
                    <strong>Ready?</strong>
                    <span>Submit once and earn points for correct answers.</span>
                </div>
                <button class="btn primary" type="submit">Submit Quiz</button>
            </div>
        </form>
    @else
        <section class="glass-panel quiz-login-panel">
            <h2>Create your ARMY profile to earn points.</h2>
            <p>You can see quizzes, but points need a logged-in account.</p>
            <div class="hero-actions">
                <a class="btn primary" href="{{ route('register') }}">Create account</a>
                <a class="btn ghost" href="{{ route('login') }}">Login</a>
            </div>
        </section>
    @endauth
@endif
@endsection
