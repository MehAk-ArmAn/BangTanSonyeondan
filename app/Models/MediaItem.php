<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'media_album_id',
        'media_type',
        'title',
        'caption',
        'file_path',
        'thumbnail_path',
        'video_url',
        'tags',
        'sort_order',
        'is_featured',
        'is_active',
        'taken_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'taken_at' => 'datetime',
        ];
    }

    public function album()
    {
        return $this->belongsTo(MediaAlbum::class, 'media_album_id');
    }

    public function scopeVisible($query)
    {
        return $query->where('is_active', true);
    }

    public function displaySrc(): ?string
    {
        return $this->file_path ?: $this->video_url;
    }

    public function thumbnailSrc(): ?string
    {
        return $this->thumbnail_path ?: $this->file_path;
    }

    public function youtubeEmbedUrl(): ?string
    {
        if ($this->media_type !== 'youtube' || ! $this->video_url) {
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
