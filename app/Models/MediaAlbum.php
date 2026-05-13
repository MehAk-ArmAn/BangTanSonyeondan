<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaAlbum extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'cover_path',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function items()
    {
        return $this->hasMany(MediaItem::class)->orderBy('sort_order')->orderByDesc('created_at');
    }

    public function activeItems()
    {
        return $this->hasMany(MediaItem::class)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at');
    }

    public function scopeVisible($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
