<?php

namespace App\Http\Controllers;

use App\Models\LearningLesson;
use App\Models\PointTransaction;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    public function index()
    {
        return view('learn.index', [
            'lessons' => LearningLesson::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function show(string $slug)
    {
        $lesson = LearningLesson::where('slug', $slug)
            ->where('is_active', true)
            ->with(['questions' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->firstOrFail();

        $bestAttempt = Auth::check()
            ? QuizAttempt::where('user_id', Auth::id())->where('learning_lesson_id', $lesson->id)->orderByDesc('score')->first()
            : null;

        return view('learn.show', compact('lesson', 'bestAttempt'));
    }

    public function submit(Request $request, LearningLesson $lesson)
    {
        $questions = $lesson->questions()->where('is_active', true)->get();
        $answers = $request->validate([
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'integer', 'min:0', 'max:5'],
        ])['answers'];

        $score = 0;
        $points = 0;
        $review = [];

        foreach ($questions as $question) {
            $picked = (int)($answers[$question->id] ?? -1);
            $correct = $picked === (int)$question->correct_option;
            if ($correct) {
                $score++;
                $points += $question->points;
            }
            $review[$question->id] = [
                'picked' => $picked,
                'correct_option' => (int)$question->correct_option,
                'correct' => $correct,
            ];
        }

        $attempt = QuizAttempt::create([
            'user_id' => Auth::id(),
            'learning_lesson_id' => $lesson->id,
            'score' => $score,
            'total' => $questions->count(),
            'points_earned' => $points,
            'answers' => $review,
        ]);

        if ($points > 0) {
            $user = Auth::user();
            $user->increment('points', $points);

            PointTransaction::create([
                'user_id' => $user->id,
                'type' => 'earn',
                'points' => $points,
                'reason' => 'Quiz reward: ' . $lesson->title,
                'meta' => ['lesson_slug' => $lesson->slug, 'attempt_id' => $attempt->id],
            ]);
        }

        return redirect()->route('learn.show', $lesson->slug)
            ->with('success', "Quiz submitted: {$score}/{$questions->count()} correct. +{$points} points.");
    }

    public function leaderboard()
    {
        return view('learn.leaderboard', [
            'users' => User::where('is_admin', false)->orderByDesc('points')->orderBy('name')->limit(50)->get(),
        ]);
    }
}
