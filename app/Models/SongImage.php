<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongImage extends Model
{
    protected $table = 'songs_images';

    protected $fillable = [
        'name', 'img_path', 'release_date', 'description', 'era', 'spotify_url', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'release_date' => 'date',
            'is_active' => 'boolean',
        ];
    }
}

