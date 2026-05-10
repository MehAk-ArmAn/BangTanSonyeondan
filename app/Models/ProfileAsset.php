<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileAsset extends Model
{
    protected $fillable = [
        'key', 'label', 'type', 'description', 'cost', 'image_path', 'avatar_image', 'theme_class', 'gradient', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'cost' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
