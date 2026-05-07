<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{
    protected $fillable = [
        'year', 'category', 'title', 'body', 'bullet_points', 'image_paths', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'bullet_points' => 'array',
            'image_paths' => 'array',
            'is_active' => 'boolean',
        ];
    }
}

