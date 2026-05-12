<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileAsset extends Model
{
    protected $fillable = [
        'key',
        'label',
        'type',
        'description',
        'cost',
        'image_path',
        'avatar_image',
        'theme_class',
        'badge_label',
        'gradient',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'cost' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}