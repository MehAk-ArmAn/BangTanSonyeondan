<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'learning_lesson_id', 'question', 'options', 'correct_option', 'explanation', 'points', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'is_active' => 'boolean',
            'correct_option' => 'integer',
            'points' => 'integer',
        ];
    }

    public function lesson()
    {
        return $this->belongsTo(LearningLesson::class, 'learning_lesson_id');
    }
}
