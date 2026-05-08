<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'is_admin', 'avatar_key', 'profile_theme',
        'bio', 'points', 'streak_days', 'last_streak_date', 'google_id', 'auth_provider',
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
}
