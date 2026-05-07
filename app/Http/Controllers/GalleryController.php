<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
        $pics = GalleryImage::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $categories = $pics->pluck('category')->filter()->unique()->values();

        return view('gallery', compact('pics', 'categories'));
    }
}
