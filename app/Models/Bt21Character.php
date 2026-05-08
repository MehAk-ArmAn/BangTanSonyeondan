<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bt21Character extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'member_name',
        'emoji',
        'image',
        'accent_color',
        'mood',
        'power',
        'anatomy',
        'moves',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'anatomy' => 'array',
            'moves' => 'array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Bt21Character $character) {
            if (blank($character->slug)) {
                $character->slug = Str::slug($character->name);
            }
        });
    }
}
