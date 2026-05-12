<?php

namespace App\Http\Controllers;

use App\Models\BtsUpdate;
use Illuminate\Http\Request;

class BtsUpdateController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));

        $updates = BtsUpdate::published()
            ->when($query !== '', function ($q) use ($query) {
                $like = '%' . $query . '%';

                $q->where(function ($inner) use ($like) {
                    $inner->where('title', 'like', $like)
                        ->orWhere('excerpt', 'like', $like)
                        ->orWhere('body', 'like', $like)
                        ->orWhere('category', 'like', $like);
                });
            })
            ->when($category !== '', fn ($q) => $q->where('category', $category))
            ->orderByDesc('is_pinned')
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->paginate(9)
            ->withQueryString();

        $categories = BtsUpdate::published()
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('updates.index', [
            'updates' => $updates,
            'categories' => $categories,
            'query' => $query,
            'category' => $category,
        ]);
    }

    public function show(BtsUpdate $update)
    {
        abort_unless(
            $update->is_active && (! $update->published_at || $update->published_at->lte(now())),
            404
        );

        $related = BtsUpdate::published()
            ->where('id', '!=', $update->id)
            ->when($update->category, fn ($q) => $q->where('category', $update->category))
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('updates.show', [
            'update' => $update,
            'related' => $related,
        ]);
    }
}