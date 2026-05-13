<?php

namespace App\Http\Controllers;

use App\Models\MediaAlbum;
use App\Models\MediaItem;
use Illuminate\Http\Request;

class MediaGalleryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $albumSlug = trim((string) $request->query('album', ''));

        $albums = MediaAlbum::visible()
            ->withCount(['activeItems as items_count'])
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $selectedAlbum = $albumSlug
            ? MediaAlbum::visible()->where('slug', $albumSlug)->first()
            : null;

        $items = MediaItem::visible()
            ->with('album')
            ->when($selectedAlbum, fn ($q) => $q->where('media_album_id', $selectedAlbum->id))
            ->when($search !== '', function ($q) use ($search) {
                $like = '%' . $search . '%';

                $q->where(function ($inner) use ($like) {
                    $inner->where('title', 'like', $like)
                        ->orWhere('caption', 'like', $like)
                        ->orWhere('tags', 'like', $like)
                        ->orWhereHas('album', fn ($album) => $album->where('title', 'like', $like));
                });
            })
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('taken_at')
            ->orderByDesc('created_at')
            ->get();

        return view('gallery.media', [
            'albums' => $albums,
            'items' => $items,
            'selectedAlbum' => $selectedAlbum,
            'search' => $search,
            'albumSlug' => $albumSlug,
        ]);
    }
}
