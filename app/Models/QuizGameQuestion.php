<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizGameQuestion extends Model
{
    protected $fillable = [
        'quiz_game_id',
        'question',
        'options',
        'correct_option',
        'explanation',
        'points',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'correct_option' => 'integer',
            'points' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function quiz()
    {
        return $this->belongsTo(QuizGame::class, 'quiz_game_id');
    }
}
