<?php

namespace App\Http\Controllers;

use App\Models\PointTransaction;
use App\Models\QuizGame;
use App\Models\QuizGameAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $difficulty = trim((string) $request->query('difficulty', ''));

        $quizzesQuery = QuizGame::visible()
            ->withCount(['questions' => fn ($q) => $q->where('is_active', true)])
            ->when($query !== '', function ($q) use ($query) {
                $like = '%' . $query . '%';
                $q->where(function ($inner) use ($like) {
                    $inner->where('title', 'like', $like)
                        ->orWhere('category', 'like', $like)
                        ->orWhere('difficulty', 'like', $like)
                        ->orWhere('description', 'like', $like);
                });
            })
            ->when($category !== '', fn ($q) => $q->where('category', $category))
            ->when($difficulty !== '', fn ($q) => $q->where('difficulty', $difficulty));

        return view('quizzes.index', [
            'quizzes' => $quizzesQuery->orderByDesc('is_featured')->orderBy('sort_order')->orderBy('title')->get(),
            'categories' => QuizGame::visible()->select('category')->distinct()->orderBy('category')->pluck('category'),
            'difficulties' => QuizGame::visible()->select('difficulty')->distinct()->orderBy('difficulty')->pluck('difficulty'),
            'query' => $query,
            'category' => $category,
            'difficulty' => $difficulty,
        ]);
    }

    public function show(QuizGame $quiz)
    {
        abort_unless($quiz->is_active, 404);

        $quiz->load(['questions' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')->orderBy('id')]);

        $bestAttempt = Auth::check()
            ? QuizGameAttempt::where('user_id', Auth::id())->where('quiz_game_id', $quiz->id)->orderByDesc('score')->orderByDesc('points_earned')->first()
            : null;

        return view('quizzes.show', compact('quiz', 'bestAttempt'));
    }

    public function submit(Request $request, QuizGame $quiz)
    {
        abort_unless($quiz->is_active, 404);

        $questions = $quiz->questions()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();

        if ($questions->isEmpty()) {
            return back()->with('error', 'This quiz has no active questions yet.');
        }

        $answers = $request->validate([
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'integer', 'min:0', 'max:10'],
        ])['answers'];

        $score = 0;
        $points = 0;
        $review = [];

        foreach ($questions as $question) {
            $picked = (int) ($answers[$question->id] ?? -1);
            $correct = $picked === (int) $question->correct_option;

            if ($correct) {
                $score++;
                $points += (int) ($question->points ?: $quiz->points_per_question ?: 10);
            }

            $review[$question->id] = [
                'picked' => $picked,
                'correct_option' => (int) $question->correct_option,
                'correct' => $correct,
            ];
        }

        if ($score === $questions->count() && $quiz->bonus_points > 0) {
            $points += (int) $quiz->bonus_points;
        }

        $accuracy = round(($score / max(1, $questions->count())) * 100, 2);

        $attempt = QuizGameAttempt::create([
            'user_id' => Auth::id(),
            'quiz_game_id' => $quiz->id,
            'score' => $score,
            'total' => $questions->count(),
            'points_earned' => $points,
            'accuracy' => $accuracy,
            'answers' => $review,
        ]);

        if ($points > 0) {
            $user = Auth::user();
            $user->increment('points', $points);

            PointTransaction::create([
                'user_id' => $user->id,
                'type' => 'earn',
                'points' => $points,
                'reason' => 'Quiz reward: ' . $quiz->title,
                'meta' => ['quiz_slug' => $quiz->slug, 'attempt_id' => $attempt->id],
            ]);
        }

        return redirect()->route('quizzes.show', $quiz->slug)
            ->with('success', "Quiz submitted: {$score}/{$questions->count()} correct. +{$points} points earned.");
    }
}
