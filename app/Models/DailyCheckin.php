<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyCheckin extends Model
{
    protected $fillable = ['user_id', 'checkin_date', 'points_earned', 'streak_after'];

    protected function casts(): array
    {
        return [
            'checkin_date' => 'date',
            'points_earned' => 'integer',
            'streak_after' => 'integer',
        ];
    }
}
