<?php

namespace App\Http\Controllers;

use App\Models\SongImage;

class SongsController extends Controller
{
    public function index()
    {
        $songs = SongImage::where('is_active', true)
            ->orderByDesc('release_date')
            ->orderBy('sort_order')
            ->get();

        $eras = $songs->pluck('era')->filter()->unique()->values();

        return view('songs', compact('songs', 'eras'));
    }
}
