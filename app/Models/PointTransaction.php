<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    protected $fillable = ['user_id', 'type', 'points', 'reason', 'meta'];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'points' => 'integer',
        ];
    }
}
