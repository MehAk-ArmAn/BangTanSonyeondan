<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizGame extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'category',
        'difficulty',
        'description',
        'cover_image',
        'time_limit_seconds',
        'points_per_question',
        'bonus_points',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'time_limit_seconds' => 'integer',
            'points_per_question' => 'integer',
            'bonus_points' => 'integer',
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function questions()
    {
        return $this->hasMany(QuizGameQuestion::class)->orderBy('sort_order')->orderBy('id');
    }

    public function attempts()
    {
        return $this->hasMany(QuizGameAttempt::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_active', true);
    }

    public function levelLabel(): string
    {
        return match ($this->difficulty) {
            'easy' => 'Rookie ARMY',
            'medium' => 'Comeback Ready',
            'hard' => 'Stage Genius',
            'legendary' => 'Borahae Legend',
            default => ucfirst((string) $this->difficulty),
        };
    }
}
