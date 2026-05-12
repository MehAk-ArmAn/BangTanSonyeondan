<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_admin',
        'avatar_key',
        'profile_theme',
        'badge_key',
        'profile_visibility',
        'bio',
        'points',
        'streak_days',
        'last_streak_date',
        'google_id',
        'auth_provider',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'last_streak_date' => 'date',
            'points' => 'integer',
            'streak_days' => 'integer',
        ];
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function quizGameAttempts()
    {
        return $this->hasMany(QuizGameAttempt::class);
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }

    public function unlockedAssets()
    {
        return $this->belongsToMany(ProfileAsset::class, 'user_profile_assets')->withPivot('unlocked_at');
    }

    public function displayName(): string
    {
        return $this->username ?: $this->name;
    }

    public function publicHandle(): string
    {
        return $this->username ?: ('army-' . $this->id);
    }

    public function publicUrl(): string
    {
        return route('profiles.show', $this->publicHandle());
    }

    public function profileInitial(): string
    {
        return Str::upper(Str::substr($this->displayName(), 0, 1)) ?: 'A';
    }
}