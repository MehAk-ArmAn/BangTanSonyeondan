<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Fields admin is allowed to update from forms.
     */
    protected $fillable = [
        'slug', 'name', 'stage_name', 'korean_name', 'role', 'image', 'quote', 'profile_story',
        'nickname', 'favicon', 'birth_date', 'birthplace', 'emoji', 'accent_color', 'bt21_character',
        'intro_title', 'fun_facts', 'skill_tags', 'spotify_url', 'instagram_url', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'fun_facts' => 'array',
            'skill_tags' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Returns a usable URL for member profile images.
     * Old rows store only filenames like rm.jfif, new rows may store uploads/members/x.jpg.
     */
    public function imageUrl(): string
    {
        if (!$this->image) {
            return asset('imgs/bts.jfif');
        }

        return str_contains($this->image, '/')
            ? asset($this->image)
            : asset('imgs/' . $this->image);
    }

    /**
     * Returns favicon URL with graceful fallback.
     */
    public function faviconUrl(): string
    {
        return $this->favicon ? asset('favicons/' . $this->favicon) : asset('favicons/logo.png');
    }
}
