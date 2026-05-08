<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id', 'learning_lesson_id', 'score', 'total', 'points_earned', 'answers',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'score' => 'integer',
            'total' => 'integer',
            'points_earned' => 'integer',
        ];
    }

    public function lesson()
    {
        return $this->belongsTo(LearningLesson::class, 'learning_lesson_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
