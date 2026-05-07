<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'member_id',
        'member_name',
        'ip_address',
        'user_agent',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}

