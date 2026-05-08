<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningLesson extends Model
{
    protected $fillable = [
        'slug', 'title', 'category', 'excerpt', 'body', 'image_path', 'reward_points', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'reward_points' => 'integer',
        ];
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('sort_order');
    }
}
