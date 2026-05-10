<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizGameAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_game_id',
        'score',
        'total',
        'points_earned',
        'accuracy',
        'answers',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'total' => 'integer',
            'points_earned' => 'integer',
            'accuracy' => 'float',
            'answers' => 'array',
        ];
    }

    public function quiz()
    {
        return $this->belongsTo(QuizGame::class, 'quiz_game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
