<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'category',
        'topic_type',
        'difficulty',
        'excerpt',
        'body',
        'image_path',
        'official_url',
        'youtube_url',
        'source_label',
        'links',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'links' => 'array',
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeVisible($query)
    {
        return $query->where('is_active', true);
    }

    public function youtubeEmbedUrl(): ?string
    {
        if (! $this->youtube_url) {
            return null;
        }

        if (str_contains($this->youtube_url, 'embed/')) {
            return $this->youtube_url;
        }

        if (preg_match('/(?:v=|youtu\.be\/|shorts\/)([A-Za-z0-9_-]{6,})/', $this->youtube_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }
}
