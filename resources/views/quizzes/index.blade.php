@extends('layouts.frontend.app')
@section('title', 'Quiz Arena · BangTanSonyeondan')
@section('content')
<section class="quiz-arena-hero">
    <div>
        <span class="eyebrow">Blooket-style BTS Quiz Arena</span>
        <h1>Search quizzes. Play levels. Earn points.</h1>
        <p>Quizzes are now totally separate from learning material. Learn in the gallery, then come here to test your ARMY brain and climb the leaderboard.</p>
        <div class="hero-actions">
            <a class="btn primary" href="{{ route('learn.index') }}">Open Learning Gallery</a>
            <a class="btn ghost" href="{{ route('leaderboard') }}">Leaderboard</a>
        </div>
    </div>
    <div class="quiz-score-tower">
        <span>Quiz modes</span>
        <b>{{ $quizzes->count() }}</b>
        <small>available now</small>
    </div>
</section>

<section class="quiz-filter-panel glass-panel">
    <form method="GET" action="{{ route('quizzes.index') }}" class="learning-filter-form">
        <label>
            Search quizzes
            <input type="search" name="q" value="{{ $query }}" placeholder="Try: rookie, MV, members, borahae...">
        </label>
        <label>
            Category
            <select name="category">
                <option value="">All categories</option>
                @foreach($categories as $item)
                    <option value="{{ $item }}" @selected($category === $item)>{{ $item }}</option>
                @endforeach
            </select>
        </label>
        <label>
            Level
            <select name="difficulty">
                <option value="">All levels</option>
                @foreach($difficulties as $item)
                    <option value="{{ $item }}" @selected($difficulty === $item)>{{ ucfirst($item) }}</option>
                @endforeach
            </select>
        </label>
        <button class="btn primary" type="submit">Find Quiz</button>
    </form>
</section>

@if($quizzes->isEmpty())
    <section class="empty-state-card">
        No quizzes found yet. Admin can add quizzes from <strong>Admin → Quizzes</strong>.
    </section>
@else
    <section class="quiz-game-grid">
        @foreach($quizzes as $quiz)
            <article class="quiz-game-card difficulty-{{ $quiz->difficulty }} {{ $quiz->is_featured ? 'featured' : '' }}">
                <div class="quiz-card-top">
                    @if($quiz->cover_image)
                        <img src="{{ asset($quiz->cover_image) }}" alt="{{ $quiz->title }}">
                    @else
                        <div class="quiz-cover-fallback">?</div>
                    @endif
                    <span>{{ $quiz->levelLabel() }}</span>
                </div>
                <div class="quiz-card-body">
                    <small>{{ $quiz->category }} · {{ $quiz->questions_count }} questions</small>
                    <h2>{{ $quiz->title }}</h2>
                    <p>{{ $quiz->description }}</p>
                    <div class="quiz-reward-row">
                        <b>+{{ number_format($quiz->points_per_question) }}</b><span>per correct</span>
                        @if($quiz->bonus_points)
                            <b>+{{ number_format($quiz->bonus_points) }}</b><span>perfect bonus</span>
                        @endif
                    </div>
                    <a class="btn primary" href="{{ route('quizzes.show', $quiz->slug) }}">Play Quiz</a>
                </div>
            </article>
        @endforeach
    </section>
@endif
@endsection
