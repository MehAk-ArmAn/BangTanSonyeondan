<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quotes';

    protected $fillable = ['source', 'quote', 'context', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}

