@extends('layouts.admin.app')
@section('title', 'Quizzes · BTS Admin')
@section('page_heading', 'Quiz Arena')
@section('content')
@include('admin.partials.page-nav')

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Blooket-style quiz control</p>
            <h2>Create Quiz Game</h2>
        </div>
        <span class="admin-chip">Searchable + points based</span>
    </div>

    <form method="POST" action="{{ route('admin.quizzes.store') }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form">
        @csrf
        <label>Quiz Title<input name="title" required placeholder="BTS 101: Rookie ARMY"></label>
        <label>Slug<input name="slug" placeholder="auto if blank"></label>
        <label>Category<input name="category" value="BTS 101" required placeholder="BTS 101 / Music Videos / Members"></label>
        <label>Difficulty
            <select name="difficulty" required>
                <option value="easy">Easy · Rookie ARMY</option>
                <option value="medium">Medium · Comeback Ready</option>
                <option value="hard">Hard · Stage Genius</option>
                <option value="legendary">Legendary · Borahae Legend</option>
            </select>
        </label>
        <label>Points Per Question<input type="number" name="points_per_question" value="10" min="0"></label>
        <label>Perfect Bonus<input type="number" name="bonus_points" value="0" min="0"></label>
        <label>Time Limit Seconds<input type="number" name="time_limit_seconds" value="0" min="0"><small>0 = no timer yet</small></label>
        <label>Sort Order<input type="number" name="sort_order" value="0" min="0"></label>
        <label class="span-2">Description<textarea name="description" maxlength="1000" placeholder="Explain what this quiz is about..."></textarea></label>
        <label>Cover Image Path<input name="cover_image" placeholder="imgs/btsssss.jfif"></label>
        <label>Upload Cover<input type="file" name="cover_file" accept="image/*"></label>
        <label class="check-row"><input type="checkbox" name="is_featured" value="1"> Featured quiz</label>
        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Visible</label>
        <button class="span-2">Create Quiz</button>
    </form>
</section>

<section class="admin-card professional-card">
    <div class="admin-card-header">
        <div>
            <p class="admin-eyebrow">Manage games + questions</p>
            <h2>Quiz Games</h2>
        </div>
        <span class="admin-chip">{{ $quizzes->count() }} quizzes</span>
    </div>

    <div class="admin-accordion-list">
        @foreach($quizzes as $quiz)
            <details class="admin-details professional-details">
                <summary>
                    <span>{{ $quiz->title }}</span>
                    <small>{{ ucfirst($quiz->difficulty) }} · {{ $quiz->questions->count() }} questions · {{ $quiz->attempts_count }} attempts</small>
                </summary>

                <form method="POST" action="{{ route('admin.quizzes.update', $quiz) }}" enctype="multipart/form-data" class="admin-grid-form admin-super-form inside-details">
                    @csrf @method('PUT')
                    <label>Quiz Title<input name="title" value="{{ $quiz->title }}" required></label>
                    <label>Slug<input name="slug" value="{{ $quiz->slug }}"></label>
                    <label>Category<input name="category" value="{{ $quiz->category }}" required></label>
                    <label>Difficulty
                        <select name="difficulty" required>
                            <option value="easy" @selected($quiz->difficulty === 'easy')>Easy · Rookie ARMY</option>
                            <option value="medium" @selected($quiz->difficulty === 'medium')>Medium · Comeback Ready</option>
                            <option value="hard" @selected($quiz->difficulty === 'hard')>Hard · Stage Genius</option>
                            <option value="legendary" @selected($quiz->difficulty === 'legendary')>Legendary · Borahae Legend</option>
                        </select>
                    </label>
                    <label>Points Per Question<input type="number" name="points_per_question" value="{{ $quiz->points_per_question }}" min="0"></label>
                    <label>Perfect Bonus<input type="number" name="bonus_points" value="{{ $quiz->bonus_points }}" min="0"></label>
                    <label>Time Limit Seconds<input type="number" name="time_limit_seconds" value="{{ $quiz->time_limit_seconds }}" min="0"></label>
                    <label>Sort Order<input type="number" name="sort_order" value="{{ $quiz->sort_order }}" min="0"></label>
                    <label class="span-2">Description<textarea name="description" maxlength="1000">{{ $quiz->description }}</textarea></label>
                    <label>Cover Image Path<input name="cover_image" value="{{ $quiz->cover_image }}"></label>
                    <label>Upload New Cover<input type="file" name="cover_file" accept="image/*"></label>
                    <label class="check-row"><input type="checkbox" name="is_featured" value="1" {{ $quiz->is_featured ? 'checked' : '' }}> Featured quiz</label>
                    <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $quiz->is_active ? 'checked' : '' }}> Visible</label>
                    <button class="span-2">Save Quiz</button>
                </form>

                <div class="inside-details quiz-question-admin-box">
                    <h3>Add Question</h3>
                    <form method="POST" action="{{ route('admin.quizzes.questions.store', $quiz) }}" class="admin-grid-form admin-super-form">
                        @csrf
                        <label class="span-2">Question<textarea name="question" required placeholder="What does BTS also stand for?"></textarea></label>
                        <label class="span-2">Options<textarea name="options_text" required placeholder="Bangtan Sonyeondan&#10;Big Time Stars&#10;Born To Sing&#10;Bright Team Seoul"></textarea><small>One answer per line. Count starts from 0.</small></label>
                        <label>Correct Option Number<input type="number" name="correct_option" value="0" min="0" max="9" required></label>
                        <label>Question Points<input type="number" name="points" value="{{ $quiz->points_per_question }}" min="0"></label>
                        <label>Sort Order<input type="number" name="sort_order" value="0" min="0"></label>
                        <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Active</label>
                        <label class="span-2">Explanation<textarea name="explanation" placeholder="Explain the answer after admin reviews results later..."></textarea></label>
                        <button class="span-2">Add Question</button>
                    </form>
                </div>

                @if($quiz->questions->isNotEmpty())
                    <div class="inside-details quiz-question-list">
                        <h3>Questions</h3>
                        @foreach($quiz->questions as $question)
                            <details class="admin-details professional-details nested-question">
                                <summary>
                                    <span>{{ Str::limit($question->question, 80) }}</span>
                                    <small>Correct: {{ $question->correct_option }} · {{ $question->points }} pts · {{ $question->is_active ? 'Active' : 'Hidden' }}</small>
                                </summary>
                                <form method="POST" action="{{ route('admin.quiz-questions.update', $question) }}" class="admin-grid-form admin-super-form inside-details">
                                    @csrf @method('PUT')
                                    <label class="span-2">Question<textarea name="question" required>{{ $question->question }}</textarea></label>
                                    <label class="span-2">Options<textarea name="options_text" required>{{ implode("\n", $question->options ?? []) }}</textarea><small>One answer per line. Correct option number starts from 0.</small></label>
                                    <label>Correct Option Number<input type="number" name="correct_option" value="{{ $question->correct_option }}" min="0" max="9" required></label>
                                    <label>Question Points<input type="number" name="points" value="{{ $question->points }}" min="0"></label>
                                    <label>Sort Order<input type="number" name="sort_order" value="{{ $question->sort_order }}" min="0"></label>
                                    <label class="check-row"><input type="checkbox" name="is_active" value="1" {{ $question->is_active ? 'checked' : '' }}> Active</label>
                                    <label class="span-2">Explanation<textarea name="explanation">{{ $question->explanation }}</textarea></label>
                                    <button class="span-2">Save Question</button>
                                </form>
                                <form method="POST" action="{{ route('admin.quiz-questions.destroy', $question) }}" onsubmit="return confirm('Delete this question?')" class="inside-details">
                                    @csrf @method('DELETE')
                                    <button class="danger">Delete Question</button>
                                </form>
                            </details>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.quizzes.destroy', $quiz) }}" onsubmit="return confirm('Delete this whole quiz and all its questions?')" class="inside-details">
                    @csrf @method('DELETE')
                    <button class="danger">Delete Whole Quiz</button>
                </form>
            </details>
        @endforeach
    </div>
</section>
@endsection
