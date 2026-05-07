<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BtsCopy extends Model
{
    // This tells Laravel what table to use.
    protected $table = 'bts_copies'; // optional (Laravel already guesses this)

    // These are the only fields allowed to be inserted using create()
    // Security feature to prevent mass-assignment hack
    protected $fillable = [
        'bts_name',
        'copy_extra_name',
        'copy_title',
        'description',
    ];
}

// Why $fillable is important?
// Without it, Laravel blocks create() for security.
