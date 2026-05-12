<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BtsUpdate extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'category',
        'source_label',
        'excerpt',
        'body',
        'image_path',
        'video_url',
        'video_path',
        'links',
        'is_pinned',
        'is_featured',
        'is_active',
        'published_at',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'links' => 'array',
            'is_pinned' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function youtubeEmbedUrl(): ?string
    {
        if (! $this->video_url) {
            return null;
        }

        if (str_contains($this->video_url, 'embed/')) {
            return $this->video_url;
        }

        if (preg_match('/(?:v=|youtu\.be\/|shorts\/)([A-Za-z0-9_-]{6,})/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }
}